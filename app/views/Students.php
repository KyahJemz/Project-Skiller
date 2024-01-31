<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row p-4 bg-white rounded-3 d-flex flex-column">
            <h4>Students List</h4>
            <input class="mt-3" id="Search" type="search" name="" id="" placeholder="search...">
            <div id="Students" class="mt-3 list-group"></div>
        </div>
    </div>

    <script>
        let StudentsArray = JSON.parse(Students);
        let ChaptersArray = JSON.parse(Chapters);
        let counterBgColor = 0;
        let StudentsList = document.getElementById('Students');
        let SearchElement = document.getElementById('Search');
        let Search = "";

        SearchElement.addEventListener('change', (e)=>{
            Search = e.target.value;
            RefreshStudentList();
        })
        
        function RefreshStudentList(){
            StudentsList.innerHTML = "";
            StudentsArray.forEach(row => {
                let Name = `${row.student.LastName}, ${row.student.FirstName} ${row.student.MiddleName??""}`;
                if(row.student.Role === "Student"){
                    if (Search) {
                        if (Name.toUpperCase().includes(Search.toUpperCase())) {
                            let view = "";
                            let TotalProgressPercentage = (((row?.progress?.FullProgress??0) / Math.max(row.progress.FullProgressTotal, 1)) * 100);
                            let TotalChaptersCount = ChaptersArray.length;
                            view += `<a href="${BASE_URL}?page=profile&item=${row.student.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                            view += `<h5>${row.student.LastName}, ${row.student.FirstName} ${row.student.MiddleName??""}</h5>`;
                            view += `<p class="m-0 p-0">Overall progress: <strong>${TotalProgressPercentage.toFixed(2)}%</strong><p>`;
                            view += `<div class="progress px-0">`;
                            ChaptersArray.forEach(chapter => {
                                let ChapterPercentage = (((Number(row?.progress?.ChapterProgress[chapter.Id]) ?? 0) / Math.max(Number(row.progress.ChapterProgressTotal[chapter.Id]), 1)) * 100)??0;
                                let adjustedWidth = (ChapterPercentage) * ((100 / (TotalChaptersCount)) / 100)??0;
                                view += `<div class="progress-bar ${getNextBgColor()}" role="progressbar" style="width: ${parseFloat(adjustedWidth)}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><strong>${isNaN(ChapterPercentage) ? 0.00 : ChapterPercentage.toFixed(2)}%</strong></div>`;
                            });
                            view += `</div>`;
                            view += `</a>`;
                            StudentsList.innerHTML += view;
                        } 
                    } else {
                        let view = "";
                            let TotalProgressPercentage = (((row?.progress?.FullProgress??0) / Math.max(row.progress.FullProgressTotal, 1)) * 100);
                            let TotalChaptersCount = ChaptersArray.length;
                            view += `<a href="${BASE_URL}?page=profile&item=${row.student.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                            view += `<h5>${row.student.LastName}, ${row.student.FirstName} ${row.student.MiddleName??""}</h5>`;
                            view += `<p class="m-0 p-0">Overall progress: <strong>${TotalProgressPercentage.toFixed(2)}%</strong><p>`;
                            view += `<div class="progress px-0">`;
                            ChaptersArray.forEach(chapter => {
                                let ChapterPercentage = (((Number(row?.progress?.ChapterProgress[chapter.Id]) ?? 0) / Math.max(Number(row.progress.ChapterProgressTotal[chapter.Id]), 1)) * 100)??0;
                                let adjustedWidth = (ChapterPercentage) * ((100 / (TotalChaptersCount)) / 100)??0;
                                view += `<div class="progress-bar ${getNextBgColor()}" role="progressbar" style="width: ${parseFloat(adjustedWidth)}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><strong>${isNaN(ChapterPercentage) ? 0.00 : ChapterPercentage.toFixed(2)}%</strong></div>`;
                            });
                            view += `</div>`;
                            view += `</a>`;
                            StudentsList.innerHTML += view;
                    }
                }
            });
        }

        RefreshStudentList();

        function getNextBgColor() {
            if (counterBgColor === 5) {
                counterBgColor = 0;
            }
            const options = [
                'bg-primary',
                'bg-success',
                'bg-danger',
                'bg-warning',
                'bg-info'
            ];
            const text = options[counterBgColor];
            counterBgColor++;
            return text;
        }
    </script>
