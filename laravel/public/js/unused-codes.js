// editor.js

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
//         });
//         return;
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
//     }).then((result) => {
//         const preview = document.getElementById('poster-preview');
//         const originalTransform = preview.style.transform;
//         preview.style.transform = 'scale(1)';

//         html2canvas(preview).then((canvas) => {
//             if (result.isConfirmed) {

//                 const imgData = canvas.toDataURL('image/png');
//                 const { jsPDF } = window.jspdf;
//                 const pdf = new jsPDF({
//                     orientation: 'portrait',
//                     unit: 'px',
//                     format: [canvas.width, canvas.height],
//                 });
//                 pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
//                 pdf.save('poster.pdf');

//                 Swal.fire({
//                     title: 'Success!',
//                     text: 'Poster exported as PDF!',
//                     icon: 'success',
//                     confirmButtonText: 'Close',
//                     customClass: {
//                       popup: 'swal2-custom-popup swal2-custom-font',
//                       confirmButton: 'swal2-confirm-custom'
//                     }
//                 });
//             } else if (result.isDenied) {
//                 // Export as PNG
//                 const link = document.createElement('a');
//                 link.download = 'poster.png';
//                 link.href = canvas.toDataURL();
//                 link.click();

//                 Swal.fire({
//                     title: 'Success!',
//                     text: 'Poster exported as PNG!',
//                     icon: 'success',
//                     confirmButtonText: 'Close',
//                     customClass: {
//                       popup: 'swal2-custom-popup swal2-custom-font',
//                       confirmButton: 'swal2-confirm-custom'
//                     }
//                 });
//             }

//             preview.style.transform = originalTransform;
//         });
//     });
// });

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
//         });
//         return;
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
//     }).then((result) => {
//         const preview = document.getElementById('poster-preview');
//         const originalTransform = preview.style.transform;
//         preview.style.transform = 'scale(2)';

//     }).then((result) => {
//         const preview = document.getElementById('poster-preview');
//         const originalTransform = preview.style.transform;
//         preview.style.transform = 'scale(2)';

//         inlineImages(preview).then(() => {
//             return domtoimage.toPng(preview, {
//                 cacheBust: true,
//                 style: {
//                     transform: 'scale(2)',
//                     transformOrigin: 'top left',
//                 }
//             });
//         }).then((dataUrl) => {
//             const img = new Image();
//             img.src = dataUrl;

//             img.onload = () => {
//                 const canvas = document.createElement('canvas');
//                 canvas.width = img.width;
//                 canvas.height = img.height;
//                 const ctx = canvas.getContext('2d');
//                 ctx.drawImage(img, 0, 0);

//                 if (result.isConfirmed) {
//                     const imgData = canvas.toDataURL('image/png');
//                     const { jsPDF } = window.jspdf;
//                     const pdf = new jsPDF({
//                         orientation: 'portrait',
//                         unit: 'px',
//                         format: [canvas.width, canvas.height],
//                     });
//                     pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
//                     pdf.save('poster.pdf');

//                     Swal.fire({
//                         title: 'Success!',
//                         text: 'Poster exported as PDF!',
//                         icon: 'success',
//                         confirmButtonText: 'Close',
//                         customClass: {
//                             popup: 'swal2-custom-popup swal2-custom-font',
//                             confirmButton: 'swal2-confirm-custom'
//                         }
//                     });
//                 } else if (result.isDenied) {
//                     const link = document.createElement('a');
//                     link.download = 'poster.png';
//                     link.href = dataUrl;
//                     link.click();

//                     Swal.fire({
//                         title: 'Success!',
//                         text: 'Poster exported as PNG!',
//                         icon: 'success',
//                         confirmButtonText: 'Close',
//                         customClass: {
//                             popup: 'swal2-custom-popup swal2-custom-font',
//                             confirmButton: 'swal2-confirm-custom'
//                         }
//                     });
//                 }

//                 preview.style.transform = originalTransform;
//             };
//         }).catch((error) => {
//             console.error('dom-to-image failed:', error);
//             preview.style.transform = originalTransform;

//             Swal.fire({
//                 title: 'Error!',
//                 text: 'Failed to export poster. Please try again.',
//                 icon: 'error',
//                 confirmButtonText: 'Close',
//                 customClass: {
//                     popup: 'swal2-custom-popup swal2-custom-font',
//                     confirmButton: 'swal2-confirm-custom'
//                 }
//             });
//         });
//     });
// });

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
