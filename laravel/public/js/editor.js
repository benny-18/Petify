let sidebarOpen = true;
let isZoomed = false;

const sidebar = document.querySelector('.sidebar');
const contentArea = document.querySelector('.content-area');
const menuIcon = document.querySelector('.icon-menu');
const closeIcon = document.querySelector('.icon-close');

const previewSection = document.getElementById("previewSection");
const posterImage = document.getElementById("poster-image");
const toggleZoomBtn = document.getElementById("toggleZoomBtn");

const projectId = document.body.dataset.projectId;

toggleZoomBtn.addEventListener("click", () => {
    if (isZoomed) {
      posterImage.style.transform = "scale(0.656)";
      toggleZoomBtn.textContent = "Zoom Image";
    } else {
      posterImage.style.transform = "none";
      toggleZoomBtn.textContent = "Fit to Panel";
    }

    isZoomed = !isZoomed;
  }
)

function toggleSidebar() {

  sidebarOpen = !sidebarOpen;
  const sidebar = document.querySelector('.sidebar');
  sidebar.classList.toggle('hidden');

  if (sidebarOpen) {
    sidebar.classList.add('visible');
    contentArea.classList.remove('full-width');
    menuIcon.classList.remove('visible');
    closeIcon.classList.add('visible');
  } else {
    sidebar.classList.remove('visible');
    contentArea.classList.add('full-width');
    closeIcon.classList.remove('visible');
    menuIcon.classList.add('visible');
  }

}

function validateRequiredFields() {
    const pet_name = document.querySelector("input[name='pet_name']");
    const pet_sex = document.querySelector("select[name='sex']");
    const contact_person = document.querySelector("input[name='contact_person']");
    const contact_number = document.querySelector("input[name='contact_number']");

    const requiredFields = [
        { field: pet_name, name: "Pet Name" },
        { field: pet_sex, name: "Sex" },
        { field: contact_person, name: "Contact Person" },
        { field: contact_number, name: "Contact Number" }
    ];

    const missingFields = [];

    requiredFields.forEach(({ field, name }) => {
        if (!field.value.trim()) {
            field.classList.add("field-error");
            missingFields.push(name);
        } else {
            field.classList.remove("field-error");
        }
    });

    return missingFields;
}

function cleanFilename() {
  const titleInput = document.querySelector("input[name='title']");
  let filename = titleInput?.value?.trim() || "poster";

  // clean illegal filenames characters symbols tas length limit
  filename = filename.replace(/[\\/:*?"<>|]/g, "").substring(0, 50);

  return filename;
}

function exportAsPNG(previewElement) {
    domtoimage.toPng(previewElement)
        .then(dataUrl => {
            const link = document.createElement('a');
            const filename = cleanFilename();
            link.download = `${filename}.png`;
            link.href = dataUrl;
            link.click();

            Swal.fire({
                icon: 'success',
                title: 'Poster exported as PNG!',
                confirmButtonText: 'Close',
                customClass: {
                    popup: 'swal2-custom-popup swal2-custom-font',
                    confirmButton: 'swal2-confirm-custom'
                }
            });
        })
}

function exportAsPDF(previewElement) {
    domtoimage.toPng(previewElement).then(dataUrl => {
        const pdf = new jspdf.jsPDF({
            orientation: "portrait",
            unit: "px",
            format: [previewElement.offsetWidth, previewElement.offsetHeight]
        });

        pdf.addImage(dataUrl, 'PNG', 0, 0, previewElement.offsetWidth, previewElement.offsetHeight);
        const filename = cleanFilename();
        pdf.save(`${filename}.pdf`);

        Swal.fire({
            icon: 'success',
            title: 'Poster exported as PDF!',
            confirmButtonText: 'Close',
            customClass: {
                popup: 'swal2-custom-popup swal2-custom-font',
                confirmButton: 'swal2-confirm-custom'
            }
        });
    })
}

function generateProjectThumbnail(projectId) {
    const preview = document.getElementById('poster-preview-static');
    if (!preview) return;

    domtoimage.toPng(preview)
        .then(originalDataUrl => {
            const img = new Image();
            img.onload = () => {
                const canvas = document.createElement('canvas');
                canvas.width = img.width / 2;
                canvas.height = img.height / 2;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                canvas.toBlob((blob) => {
                    const formData = new FormData();
                    formData.append('thumbnail', blob, `${projectId}_thumb.png`);
                    formData.append('project_id', projectId);

                    fetch('/projects/upload-thumbnail', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                        .then(res => res.json());
                }, 'image/png');
            };

            img.src = originalDataUrl;
        })
}

document.getElementById("back-to-dashboard-btn").addEventListener("click", function (e) {
    e.preventDefault();

    Swal.fire({
        icon: 'info',
        title: 'Saving project...',
        html: 'Please wait while we save your project.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        customClass: {
            popup: 'swal2-custom-popup swal2-custom-font',
            confirmButton: 'swal2-confirm-custom'
        },
        // didOpen: () => {
        //     Swal.showLoading();
        // }
    });

    generateProjectThumbnail(projectId);
    setTimeout(() => {
        window.location.href = '/dashboard';
    }, 2000);
});


document.getElementById("saveDownloadBtn").addEventListener("click", function (e) {
    e.preventDefault();

    const missingFields = validateRequiredFields();
    if (missingFields.length > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops! Missing Info',
            html: `
                <p style="font-weight: bold" class="swal2-custom-font">Please fill out the following required fields:</p>
                <p class="swal2-custom-font" style="text-align: center; margin: 10px 0;">
                    ${missingFields.join(', ')}
                </p>
            `,
            confirmButtonText: 'Okay, got it!',
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-font',
                confirmButton: 'swal2-confirm-custom',
            }
        });
        return;
    }

    const preview = document.getElementById('poster-preview-static');

    Swal.fire({
        title: 'Choose format',
        text: 'Which format do you want Petify to save the file as?',
        icon: 'question',
        showCancelButton: true,
        showDenyButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Save as PNG',
        denyButtonText: 'Save as PDF',
        customClass: {
            popup: 'swal2-custom-popup swal2-custom-font',
            confirmButton: 'swal2-confirm-custom',
            denyButton: 'swal2-confirm-custom',
            cancelButton: 'swal2-cancel-default'
        }
    }).then(result => {
        if (result.isConfirmed) {
            exportAsPNG(preview);
        } else if (result.isDenied) {
            exportAsPDF(preview);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#editorForm');
    const saveSuccess = document.getElementById('save-success');
    const saveProgress = document.getElementById('save-progress');

    let autosaveTimer;

    document.querySelectorAll('#editorForm input, #editorForm select, #editorForm textarea').forEach(field => {
        field.addEventListener('input', () => {
            clearTimeout(autosaveTimer);

            if (saveProgress.style.display !== 'flex') {
                showSavingIndicator();
            }

            autosaveTimer = setTimeout(() => {
                autosaveForm();
            }, 500);
        });
    });


    document.querySelectorAll('.template-item').forEach(item => {
        item.addEventListener('click', () => {
          const templateId = item.dataset.templateId;
          const projectId = document.querySelector('#project-id').value;

          fetch(`/projects/${projectId}/change-template`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ template_id: templateId })
          })
          .then(response => {
            return response.json();
          })
          .then(data => {
            window.location.reload();
          })
        });
      });

    function autosaveForm() {
        const formData = new FormData(form);
        const projectId = form.dataset.projectId;

        fetch(`/projects/${projectId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                showSaved();
            } else {
                showSaving(false);
            }
        })
        generateProjectThumbnail(projectId);
    }

    function showSavingIndicator() {
        fadeOut(saveSuccess);
        fadeIn(saveProgress);
    }

    function getPosterEditorComponent() {
        const wireId = document.querySelector('#poster-preview [wire\\:id]')?.getAttribute('wire:id');
        return wireId ? Livewire.find(wireId) : null;
    }

    function updatePosterEditor() {
        const component = getPosterEditorComponent();
        if (!component) return;

        component.set('petName', document.querySelector('[name="pet_name"]').value);
        component.set('petDescription', document.querySelector('[name="pet_description"]').value);
        component.set('petBreed', document.querySelector('[name="breed"]').value);
        component.set('petAge', document.querySelector('[name="age"]').value);
        component.set('petSex', document.querySelector('[name="sex"]').value);
        component.set('contactPerson', document.querySelector('[name="contact_person"]').value);
        component.set('contactNumber', document.querySelector('[name="contact_number"]').value);

        generateProjectThumbnail(projectId);
    }


    function showSaved() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const timeHTML = `Changes saved! <span style="font-weight: normal; font-size: 13px;">(at ${formattedTime})</span>`;
        saveSuccess.querySelector('h2').innerHTML = timeHTML;

        Livewire.dispatch('refreshPreview');

        fadeOut(saveProgress);

        setTimeout(() => {
            fadeIn(saveSuccess);
            updatePosterEditor();
        }, 150);
    }

    function fadeIn(el) {
        el.style.display = 'flex';
        setTimeout(() => el.style.opacity = 1, 10);
    }

    function fadeOut(el) {
        el.style.opacity = 0;
        setTimeout(() => el.style.display = 'none', 500);
    }
});

//notfinal
function handleImageImport(event) {
  const fileInput = event.target;
  const fileName = fileInput.files[0]?.name || "No file chosen";
  document.getElementById("fake-file-name").value = fileName;
}

function handleImageUpload() {
  setTimeout(() => {
      location.reload();
  }, 1000);
  showSaved();
}


