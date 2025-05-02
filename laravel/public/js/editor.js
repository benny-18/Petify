let sidebarOpen = true;
let isZoomed = true;

const sidebar = document.querySelector('.sidebar');
const contentArea = document.querySelector('.content-area');
const menuIcon = document.querySelector('.icon-menu');
const closeIcon = document.querySelector('.icon-close');

const previewSection = document.getElementById("previewSection");
const toggleZoomBtn = document.getElementById("toggleZoomBtn");

// toggleZoomBtn.addEventListener("click", () => {
//     if (isZoomed) {
//       // Switch to Fit Mode
//       previewSection.style.alignItems = "initial";
//       previewSection.style.padding = "0px";
//       toggleZoomBtn.textContent = "Zoom Image";
//     } else {
//       // Switch to Zoom Mode
//       previewSection.style.alignItems = "start";
//       previewSection.style.padding = "50px";
//       toggleZoomBtn.textContent = "Fit to Panel";
//     }

//     isZoomed = !isZoomed;
//   }
// )

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

document.getElementById("saveDownloadBtn").addEventListener("click", function (e) {
    e.preventDefault();

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

    let missingFields = [];

    requiredFields.forEach(({ field, name }) => {
      if (!field.value || field.value.trim() === "") {
        field.classList.add("field-error");
        missingFields.push(name);
      } else {
        field.classList.remove("field-error");
      }
    });

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

    Swal.fire({
        title: 'Choose format',
        text: 'Which format do you want Petify to save the file as?',
        icon: 'question',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonText: 'Save as PDF',
        denyButtonText: 'Save as PNG',
        cancelButtonText: 'Cancel',
        customClass: {
          popup: 'swal2-custom-popup swal2-custom-font',
          confirmButton: 'swal2-confirm-custom',
          denyButton: 'swal2-confirm-custom',
          cancelButton: 'swal2-cancel-default'
        },
        backdrop: `
          rgba(0, 0, 0, 0.4)
          blur(5px)
        `
    }).then((result) => {
        const preview = document.getElementById('poster-preview');
        const originalTransform = preview.style.transform;
        preview.style.transform = 'scale(1)';

        html2canvas(preview).then((canvas) => {
            if (result.isConfirmed) {

                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'px',
                    format: [canvas.width, canvas.height],
                });
                pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
                pdf.save('poster.pdf');

                Swal.fire({
                    title: 'Success!',
                    text: 'Poster exported as PDF!',
                    icon: 'success',
                    confirmButtonText: 'Close',
                    customClass: {
                      popup: 'swal2-custom-popup swal2-custom-font',
                      confirmButton: 'swal2-confirm-custom'
                    }
                });
            } else if (result.isDenied) {
                // Export as PNG
                const link = document.createElement('a');
                link.download = 'poster.png';
                link.href = canvas.toDataURL();
                link.click();

                Swal.fire({
                    title: 'Success!',
                    text: 'Poster exported as PNG!',
                    icon: 'success',
                    confirmButtonText: 'Close',
                    customClass: {
                      popup: 'swal2-custom-popup swal2-custom-font',
                      confirmButton: 'swal2-confirm-custom'
                    }
                });
            }

            preview.style.transform = originalTransform;
        });
    });
});

// document.getElementById("saveDownloadBtn").addEventListener("click", function (e) {
//     e.preventDefault();

//     const pet_name = document.querySelector("input[name='pet_name']");
//     const pet_sex = document.querySelector("select[name='sex']");
//     const contact_person = document.querySelector("input[name='contact_person']");
//     const contact_number = document.querySelector("input[name='contact_number']");

//     const requiredFields = [
//       { field: pet_name, name: "Pet Name" },
//       { field: pet_sex, name: "Sex" },
//       { field: contact_person, name: "Contact Person" },
//       { field: contact_number, name: "Contact Number" }
//     ];

//     let missingFields = [];

//     requiredFields.forEach(({ field, name }) => {
//       if (!field.value || field.value.trim() === "") {
//         field.classList.add("field-error");
//         missingFields.push(name);
//       } else {
//         field.classList.remove("field-error");
//       }
//     });

//     if (missingFields.length > 0) {
//         Swal.fire({
//             icon: 'warning',
//             title: 'Oops! Missing Info',
//             html: `
//                 <p style="font-weight: bold" class="swal2-custom-font">Please fill out the following required fields:</p>
//                 <p class="swal2-custom-font" style="text-align: center; margin: 10px 0;">
//                 ${missingFields.join(', ')}
//                 </p>
//             `,
//             confirmButtonText: 'Okay, got it!',
//             customClass: {
//               popup: 'swal2-custom-popup',
//               title: 'swal2-custom-font',
//               confirmButton: 'swal2-confirm-custom',
//             }
//           });
//       return;
//     }

//     Swal.fire({
//         title: 'Choose format',
//         text: 'Which format do you want Petify to save the file as?',
//         icon: 'question',
//         showCancelButton: true,
//         showDenyButton: true,
//         confirmButtonText: 'Save as PDF',
//         denyButtonText: 'Save as PNG',
//         cancelButtonText: 'Cancel',
//         customClass: {
//           popup: 'swal2-custom-popup swal2-custom-font',
//           confirmButton: 'swal2-confirm-custom',
//           denyButton: 'swal2-confirm-custom',
//           cancelButton: 'swal2-cancel-default'
//         },
//         backdrop: `
//           rgba(0, 0, 0, 0.4)
//           blur(5px)
//         `
//       }).then((result) => {
//         if (result.isConfirmed) {
//           Swal.fire({
//             title: 'Success!',
//             text: 'Image exported as PDF!',
//             icon: 'success',
//             confirmButtonText: 'Close',
//             customClass: {
//               popup: 'swal2-custom-popup swal2-custom-font',
//               confirmButton: 'swal2-confirm-custom'
//             }
//           });
//         } else if (result.isDenied) {
//           Swal.fire({
//             title: 'Success!',
//             text: 'Image exported as PNG!',
//             icon: 'success',
//             confirmButtonText: 'Close',
//             customClass: {
//               popup: 'swal2-custom-popup swal2-custom-font',
//               confirmButton: 'swal2-confirm-custom'
//             }
//           });
//         }
//       });
// });

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#editorForm');
    const saveSuccess = document.getElementById('save-success');
    const saveProgress = document.getElementById('save-progress');

    let autosaveTimer;

    // setTimeout(function () {
    //   const loader = document.getElementById('loader');
    //   loader.classList.add('fade-out');
    //   setTimeout(() => {
    //     loader.style.display = 'none';
    //   }, 500);
    // }, 1000);

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
          const projectId = document.querySelector('#project-id').value; // Make sure this input exists

          fetch(`/projects/${projectId}/change-template`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ template_id: templateId })
          })
          .then(response => {
            if (!response.ok) throw new Error('Failed to update template.');
            return response.json();
          })
          .then(data => {
            window.location.reload();
          })
          .catch(error => console.error(error));
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
                return response.json().then(err => {
                    console.error("Autosave failed", err);
                    showSaving(false);
                });
            }
        })
        .catch(error => {
            console.error("Autosave failed", error);
            showSaving(false);
        });
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
        }, 2000);
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
  // Give Livewire a moment to handle the image upload,
  // then reload the browser after a short delay
  setTimeout(() => {
      location.reload();
  }, 1500); // Wait 1.5 seconds (adjust if needed)
  showSaved();
}


