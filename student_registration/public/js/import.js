function printStudentDetails(studentId) {
    const studentRow = document.getElementById(`student-row-${studentId}`);
    if (!studentRow) {
        console.error("Student row not found!");
        return;
    }

    // Extract student details
    const studentData = {
        reference: studentRow.cells[6]?.textContent.trim() || "N/A",
        firstName: studentRow.cells[1]?.textContent.trim() || "N/A",
        lastName: studentRow.cells[2]?.textContent.trim() || "N/A",
        gender: studentRow.cells[3]?.textContent.trim() || "N/A",
        dob: studentRow.cells[10]?.textContent.trim() || "N/A",
        email: studentRow.cells[4]?.textContent.trim() || "N/A",
        mobile: studentRow.cells[5]?.textContent.trim() || "N/A",
        uid: studentRow.cells[6]?.textContent.trim() || "N/A",
        degree: studentRow.cells[7]?.textContent.trim() || "N/A",
        specialization: studentRow.cells[8]?.textContent.trim() || "N/A",
        school: studentRow.cells[9]?.textContent.trim() || "N/A",
        country: studentRow.cells[11]?.textContent.trim() || "N/A",
        state: studentRow.cells[12]?.textContent.trim() || "N/A",
        district: studentRow.cells[13]?.textContent.trim() || "N/A",
        pinCode: studentRow.cells[14]?.textContent.trim() || "N/A",
        photo: studentRow.cells[15]?.querySelector("img")?.src || "",
        signature: studentRow.cells[16]?.querySelector("img")?.src || "",
    };

    // Open a new print window
    const printWindow = window.open("", "_blank");

    if (!printWindow) {
        alert("Pop-up blocked! Allow pop-ups for this site.");
        return;
    }

    printWindow.document.write(`
 <html>
        <head>
            <title>Student Details</title>
            <style>
                @media print {
                   
                *{
    font-family: "Poppins", sans-serif;
    line-height: 1;
}
                body { margin: .5cm; color: #000; }
                    .header {
                        text-align: center;
                        padding-bottom: 5px;
                        margin-bottom: 10px;
                        font-size: 20px;
                        font-weight: bold;
                    }

                    .section {
                        width: 100%;
                        border: 1px solid #000;
                        margin-bottom: 10px;
                    }

                    .section-title {
                        background: #9ACDFF;
                        padding: 8px;
                        font-weight: bold;
                        font-size: 14px;
                        border-bottom: 1px solid #000;
                    }

                    .section-content {
                        padding: 5px;
                    }

                    .details-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 10px;
                    }

                    .details-table td {
                        padding: 4px;
                        border: 1px solid #000;
                    }

                    .details-table td:first-child {
                        font-weight: bold;
                        background: #E3F2FD;
                        width: 30%;
                    }

                    .photo-container {
                    margin:1px;
                        height: 140px;
                        max-height: 200px;
                        text-align: center;
                        padding: 1px;
                        flex-direction: column;                        
                    }
                    
                    .photo {
                        max-width: 200px;
                        height: 140px;
                        border: 1px solid rgb(0, 0, 0);
                        overflaw:hidden;
                    }
                        .signature {
                        max-width: 100px;
                        height: 40px;
                        margin-top:5px;
                        overflaw:hidden;
                    }

                    .section-flex {
                        display: flex;
                    }

                    .section-flex .section-content {
                        width: 60%;
                    }

                    .section-flex .photo-container {
                        width: 40%;
                    }
                }
            </style>
        </head>
        <body>

            <div class="header">STUDENT INFORMATION</div>

            <div class="section section-flex">
                <div class="section-title">BASIC DETAILS</div>
                <div class="section-content">
                    <table class="details-table">
                        <tr><td>Reference ID</td><td>${
                            studentData.reference
                        }</td></tr>
                    </table>
                </div>
                <div class="photo-container">
                    ${
                        studentData.photo
                            ? `<img id="photo" class="photo" src="${studentData.photo}" alt="Student Photo">`
                            : "<p>No Photo</p>"
                    }
                   </div>

            </div>

            <div class="section">
                <div class="section-title">PERSONAL DETAILS</div>
                <div class="section-content">
                    <table class="details-table">
                        <tr><td>Name</td><td>${studentData.firstName} ${
        studentData.lastName
    }</td></tr>
                        <tr><td>Gender</td><td>${studentData.gender}</td></tr>
                        <tr><td>Date of Birth</td><td>${
                            studentData.dob
                        }</td></tr>
                        <tr><td>Email</td><td>${studentData.email}</td></tr>
                        <tr><td>Mobile</td><td>${studentData.mobile}</td></tr>
                    </table>
                </div>
            </div>

            <div class="section">
                <div class="section-title">ACADEMIC DETAILS</div>
                <div class="section-content">
                    <table class="details-table">
                        <tr><td>UID</td><td>${studentData.uid}</td></tr>
                        <tr><td>Degree</td><td>${studentData.degree}</td></tr>
                        <tr><td>Specialization</td><td>${
                            studentData.specialization
                        }</td></tr>
                        <tr><td>School</td><td>${studentData.school}</td></tr>
                    </table>
                </div>
            </div>

            <div class="section">
                <div class="section-title">ADDRESS DETAILS</div>
                <div class="section-content">
                    <table class="details-table">
                        <tr><td>Country</td><td>${studentData.country}</td></tr>
                        <tr><td>State</td><td>${studentData.state}</td></tr>
                        <tr><td>District</td><td>${
                            studentData.district
                        }</td></tr>
                        <tr><td>Pin Code</td><td>${
                            studentData.pinCode
                        }</td></tr>
                    </table>
                </div>
            </div>
            <div class="section">
            <div class="section-content">
            <span> I ${studentData.firstName} ${
        studentData.lastName
    }, solemnly declare that the information in this form is truly stated and correct and I am competent to
 furnish as well as verify it with adequate details whenever requested for.</span><br><br><span>Signature</span>
                 <div>
                    ${
                        studentData.signature
                            ? `<img class="signature" id="signature" src="${studentData.signature}" alt="Signature">`
                            : "<p>No Signature</p>"
                    }
                </div>
            </div>
            </div>
 <script>
setTimeout(() => {
    window.print();
    window.close();
}, 500);
</script> 
        </body>
        </html>
    `);

    printWindow.document.close();
}
