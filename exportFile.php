<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="./jsPDF/dist/jspdf.umd.js"></script>
    <script src="html2canvas.min.js"></script> 

</head>
<body>

<!-- ======================================================================================== -->
    <?php
        // excample data_query
        $data_query = [
            array('Name' => 'John Doe', 'Age' => 30, 'Email' => 'john@example.com'),
            array('Name' => 'Jane Smith', 'Age' => 25, 'Email' => 'jane@example.com'),
            array('Name' => 'Bob Johnson', 'Age' => 35, 'Email' => 'bob@example.com')
        ];
        $json_data = json_encode($data_query);
    ?>

    <button onclick="exportExcel(<?php echo htmlspecialchars($json_data); ?>, 'ทดสอบ')">Download Excel</button>
<!-- ======================================================================================== -->
    
    
    <button onclick="exportPDF()">Export to PDF</button>
<!-- ======================================================================================== -->
    <!-- มันจะ export pdf ใน div นี้ทั้งหมด  -->
    <div id="contentToPrint">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat, perferendis?
        <canvas id="myChart"></canvas>
    </div>
<!-- ======================================================================================== -->

    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script> <!-- export excel --> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    
    <script>
// ===================================================================================

        const exportExcel = (data, name_file) => { // รับค่า data_query , ชื่อ file
            console.log("Click export excel.....")
            console.log("data ====> ", data)

            const workbook = XLSX.utils.book_new(); // Create a new workbook
            const worksheet = XLSX.utils.json_to_sheet(data) // Convert data to a worksheet
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1') // Add the worksheet to the workbook
            XLSX.writeFile(workbook, `${name_file}.xlsx`); // Save the workbook as a file
        }


// ===================================================================================
        const exportPDF = () => {
            console.log("Click export pdf.....")
            window.jsPDF = window.jspdf.jsPDF
            const doc = new jsPDF();
            var elementHTML = document.querySelector("#contentToPrint");
            const canvasImg = canvas.toDataURL('image/jpeg',1.0)

            doc.html(elementHTML, {
                callback: function(doc) {
                    // Save the PDF
                    doc.save('document-html.pdf');
                },
                margin: [10, 10, 10, 10],
                autoPaging: 'text',
                x: 0,
                y: 0,
                width: 190, //target width in the PDF document
                windowWidth: 675 //window width in CSS pixels
            });
        }


// ===================================================================================
        const showChart = () => {
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                },
                }
            });
        }
        showChart()
    </script>
</body>
</html>
