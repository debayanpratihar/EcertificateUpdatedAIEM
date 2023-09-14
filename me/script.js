// script.js

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("certificateForm");
  form.addEventListener("submit", generateCertificate);
});

function generateCertificate(event) {
  event.preventDefault(); // Prevent form submission

  const name = document.getElementById("name").value;
  const eventName = document.getElementById("eventName").value;
  const eventDate = document.getElementById("eventDate").value;
  const signatureInput = document.getElementById("signature");

  if (!name || !eventName || !eventDate) {
    alert("Please fill in all required fields.");
    return;
  }

  if (!signatureInput.files[0]) {
    alert("Please upload a PNG signature.");
    return;
  }

  const certificateImage = new Image();
  certificateImage.src = "certificate.png";

  const uploadedSignature = new Image();
  uploadedSignature.src = URL.createObjectURL(signatureInput.files[0]);

  uploadedSignature.onload = function () {
    certificateImage.onload = function () {
      // Create a new PDF document
      const doc = new jsPDF();
      const width = doc.internal.pageSize.width;
      const height = doc.internal.pageSize.height;

      // Calculate the scaling factor to fit the certificate image within the PDF page
      const scaleFactor = Math.min(width / certificateImage.width, height / certificateImage.height);

      // Calculate the dimensions of the scaled certificate image
      const scaledWidth = certificateImage.width * scaleFactor;
      const scaledHeight = certificateImage.height * scaleFactor;

      // Add the certificate image to the PDF in the center
      doc.addImage(
        certificateImage,
        "PNG",
        (width - scaledWidth) / 2,
        (height - scaledHeight) / 2,
        scaledWidth,
        scaledHeight
      );

    // Add the uploaded signature as an image in the bottom right corner
// Define the signature width and height (adjust as needed)
const signatureWidth = 50;
const signatureHeight = 25;

// Define the horizontal and vertical position of the signature (adjust as needed)
const signatureX = 150; // Adjust the horizontal position
const signatureY = 190; // Adjust the vertical position

// Add the uploaded signature as an image
doc.addImage(
  uploadedSignature,
  "PNG",
  signatureX,
  signatureY,
  signatureWidth,
  signatureHeight
);


      // Add the text to the PDF document
    doc.setFontSize(30);
    doc.setTextColor(0, 32, 63);
    doc.setFont('Blackadder ITC', 'bold');
    
    // Center the name vertically and horizontally
    const nameTextWidth = doc.getStringUnitWidth(name) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    const nameTextX = (width - nameTextWidth) / 2;
    doc.text(name, nameTextX, height / 2 - 5); // Adjust the vertical position as needed
    
    doc.setFontSize(20);
    doc.setTextColor(0, 0, 0);
    doc.setFont('Blackadder ITC', 'bold');

    // Center the event details vertically and horizontally
    const eventText = `for attending ${eventName} on ${eventDate}.`;
    const eventTextWidth = doc.getStringUnitWidth(eventText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    const eventTextX = (width - eventTextWidth) / 2;
    doc.text(eventText, eventTextX, height / 2 + 10); // Adjust the vertical position as needed

      // Save the PDF document with the user's name and event name
      doc.save(`${name}_${eventName}_certificate.pdf`);
    };
  };
}
