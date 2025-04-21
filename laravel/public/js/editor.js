// const toggleBtn = document.getElementById('toggleSidebar');
// const sidebar = document.getElementById('sidebar');

// toggleBtn.addEventListener('click', () => {
//   sidebar.classList.toggle('hidden');
// });

let sidebarOpen = true;
let isZoomed = true;

const sidebar = document.querySelector('.sidebar');
const contentArea = document.querySelector('.content-area');
const menuIcon = document.querySelector('.icon-menu');
const closeIcon = document.querySelector('.icon-close');

const previewSection = document.getElementById("previewSection");
const toggleZoomBtn = document.getElementById("toggleZoomBtn");

toggleZoomBtn.addEventListener("click", () => {
    if (isZoomed) {
      // Switch to Fit Mode
      previewSection.style.alignItems = "initial";
      previewSection.style.padding = "0px";
      toggleZoomBtn.textContent = "Zoom Image";
    } else {
      // Switch to Zoom Mode
      previewSection.style.alignItems = "start";
      previewSection.style.padding = "50px";
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

// document.getElementById("saveDownloadBtn").addEventListener("click", () => {
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
//           // simulate success PDF
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
//           // simulate success PNG
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
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//           // do nothing or handle cancel
//         }
//       });
//   });

  document.getElementById("saveDownloadBtn").addEventListener("click", function () {

    const petName = document.querySelector("input[name='petName']");
    const petSex = document.querySelector("select[name='petSex']");
    const contactPerson = document.querySelector("input[name='contactPerson']");
    const contactNumber = document.querySelector("input[name='contactNumber']");

    const requiredFields = [
      { field: petName, name: "Pet Name" },
      { field: petSex, name: "Sex" },
      { field: contactPerson, name: "Contact Person" },
      { field: contactNumber, name: "Contact Number" }
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
        if (result.isConfirmed) {
          // simulate success PDF
          Swal.fire({
            title: 'Success!',
            text: 'Image exported as PDF!',
            icon: 'success',
            confirmButtonText: 'Close',
            customClass: {
              popup: 'swal2-custom-popup swal2-custom-font',
              confirmButton: 'swal2-confirm-custom'
            }
          });
        } else if (result.isDenied) {
          // simulate success PNG
          Swal.fire({
            title: 'Success!',
            text: 'Image exported as PNG!',
            icon: 'success',
            confirmButtonText: 'Close',
            customClass: {
              popup: 'swal2-custom-popup swal2-custom-font',
              confirmButton: 'swal2-confirm-custom'
            }
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          // do nothing or handle cancel
        }
      });
  });
