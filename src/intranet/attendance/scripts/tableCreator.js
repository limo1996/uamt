var m_names = [];
var m_ids = [];
var m_dictionary;

var lastX = null;
var lastY = null;
var editEnabled = false;
var globalMonth = 5;
var globalYear = 2017;
var canUserEdit = false;
var onlyName = null;

function getMonthDaysCount(month, year){
    return new Date(year, month, 0).getDate();
}

function printTable(month, year, employees, employeesDays){
    var table = "<table class='table table-bordered' id='mainTable'>";
    var monthCount = getMonthDaysCount(month, year);
    for(var i = 0; i <= employees.length; i++) {
        var classTd = "tdEditable";
        if (onlyName != null && i !== 0 && employees[i - 1].indexOf(onlyName) === -1) {
            classTd = "";
        }
        if (i == 0)
            table += "<tr><th>Meno</th>";
        else
            table += "<tr><th class='persons text-center' id='" + (i - 1).toString() + "'>" + employees[i - 1] + "</th>";
        for (var j = 1; j <= monthCount; j++) {
            if (i == 0) {
                var day = getDay(year, month, j);
                var insert = "";
                if (day == "Sun" || day == "Sat")
                    insert = "style='color: #eb9316;'";
                table += "<th " + insert + "class='text-center'> " + j + "<br/>" + day + "</th>";
            }
            else {
                var name = employeesDays[m_names[i - 1]];
                table += "<td style='background: " + getAbsenceColor(name[j - 1]) + ";' class='" + classTd + "'></td>";
            }
        }
        table += "</tr>";
    }

    table += "</table>";
    var fuck = document.getElementById("tableDiv");
    fuck.innerHTML = table;
        $(".persons").click(function (){
        if(!editEnabled) return;
        var id = $(this).attr('id');
        $("#ModalName").html(m_names[parseInt(id)]);
        printSmallTable(globalMonth, globalYear, parseInt(id), m_dictionary[m_names[id]]);
        $('#myModal').modal('toggle');
    });
}

function colorChanged() {
    var e = document.getElementById("editor");
    var id = e.options[e.selectedIndex].value;
    markColor = getAbsenceColor(id);
}

function printSmallTable(month, year, iid, data){
    var table = "<table class='table table-bordered' id='userTable'><tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr><tr>";
    var tmpDate = new Date(year, month - 1, 1);
    tmpDate = tmpDate.getDay();
    if(tmpDate == 0) tmpDate = 7;
    for(var i = 0; i < tmpDate - 1; i++){
        table += "<td></td>";
    }
    var monthCount = getMonthDaysCount(month, year);
    for(var i = 1; i <= monthCount; i++){
        table += "<td class='editable' style='background:" + getAbsenceColor(data[i - 1]) + "';>" + i.toString() +"</td>";
        if(getDay(year, month, i) == 'Sun' && i != monthCount)
            table += "</tr><tr>";
    }
    table += "</tr></table>";
    var down = false;
    $("#smallTableDiv").html(table);
    $(".editable").mousedown(function() {
        if(!editEnabled) return;
        mark($(this), false);
        var rr = iid + 1;
        var cc = parseInt($(this).html()) - 1;
        var el = getElementAt(rr, cc);
        mark(el, true);
        setXY($(this));
        down = true;
    }).mousemove(function() {
        if(!editEnabled) return;
        if (down == true && (lastX != getX($(this)) || lastY != getY($(this)))){
            setXY($(this));
            last = $(this);
            mark($(this), false);
            var rr = iid + 1;
            var cc = parseInt($(this).html()) - 1;
            var el = getElementAt(rr, cc);
            mark(el, true);
        }
    });
    $(document).mouseup(function() {
        if(!editEnabled) return;
        down = false;
    });
}

function getElementAt(row, column) {
    var ret;
    $("#tableDiv tr").each(function(rowIndex) {
        $(this).find("td").each(function(cellIndex) {
            if (cellIndex == column && rowIndex == row)
                ret = $(this);
        });
    });
    return ret;
}

$(document).ready(function(){
    canUserEdit = document.getElementsByClassName('disabled').length == 0;
    if(!canUserEdit)
        onlyName = document.getElementById("currName").innerText;

    console.log("fuck " + canUserEdit);
    getAndPrintTable(5, 2017);
    $('#NoIconDemo').MonthPicker({ Button: false, 
                                   SelectedMonth: 'May, 2017',
                                   MonthFormat: 'M, yy',
                                   OnAfterChooseMonth: function() { 
                                        var date = $(this).val().replace(/ /g,'');
                                        var splited = date.split(',');
                                        var month = parseInt(getMonthFromString(splited[0]), 10);
                                        var year = parseInt(splited[1], 10);
                                        globalYear = year;
                                        globalMonth = month;
                                       getAndPrintTable(month, year);
                                    }});
    $('#selector').hide();
    $('#editBtn').click(function(){
        var value = $(this).text();
        if(value == "Edituj"){
            $(this).html('Ulož');
            $('#selector').show();
            editEnabled = true;
            $('#NoIconDemo').attr('disabled', true);
        }
        else{
            $(this).html('Edituj');
            $('#selector').hide();
            editEnabled = false;
            deleteRecords();
            $('#NoIconDemo').attr('disabled', false);
        }
    });

    $('.tableChoise').click(function (){
        var id = $(this).attr('id');
        if (!canUserEdit && id != '5')
            return;

        markColor = getAbsenceColor(id);
    });
});

function getAbsenceColor(id) {
    if(id == null || isNaN(id))
        return "#FFFFFF";
    var color;
    if(id == 1) color = "#265a88";
    else if (id == 2) color = "#419641";
    else if (id == 3) color = "#2aabd2";
    else if (id == 4) color = "#eb9316";
    else color = "#c12e2a";
    return color;
}

function getAbsenceLetter(id) {
    if(id == null || isNaN(id))
        return "";
    var color;
    if(id == 1) color = "PN";
    else if (id == 2) color = "O";
    else if (id == 3) color = "S";
    else if (id == 4) color = "D";
    else color = "P";
    return color;
}

function getAndPrintTable(month, year) {
    $.post("/uamt/intranet/attendance/php/getAbsences.php", {'month' : month, 'year' : year }, function (data, status) {
        data = JSON.parse(data);
        var names = data[0];
        var dictionary = data[1];
        m_dictionary = dictionary;
        m_names = names;
        m_ids = data[2];
        var tmp = dictionary[names[0]];
        var down = false;
        printTable(month, year, names, dictionary);
        $(".tdEditable").mousedown(function() {
            if(!editEnabled) return;
            mark($(this), true);
            setXY($(this));
            down = true;

            var xx = getX($(this));
            var yy = getY($(this));
            m_dictionary[m_names[xx - 1]][yy -1] = getAbsenceId(markColor);
        }).mousemove(function() {
            if(!editEnabled) return;
            if (down == true && (lastX == getX($(this)) && lastY != getY($(this)))){
                setXY($(this));
                last = $(this);
                mark($(this), true);
                var xx = getX($(this));
                var yy = getY($(this));
                m_dictionary[m_names[xx - 1]][yy -1] = getAbsenceId(markColor);
            }
        });
        $(document).mouseup(function() {
            if(!editEnabled) return;
            down = false;
        });
    });
}

function getMonthFromString(mon){
   return new Date(Date.parse(mon +" 1, 2012")).getMonth() + 1;
}

function setXY(item){
    lastX = getX(item);
    lastY = getY(item);
}

function getX(item){
    return item.parent().parent().children().index(item.parent());
}

function getY(item){
    return item.parent().children().index(item);
}

var markColor = "#c12e2a";
function mark(item, edit){
    var id = item.attr('id');
    var row = getX(item);
    var coll = getY(item);
    var col = rgb2hex(item.css('backgroundColor').toString());

    var absence = [globalYear.toString() + '-' + globalMonth.toString() + '-' + coll.toString(), parseInt(m_ids[row-1]), getAbsenceId(markColor)];
    //delete
    if(col == markColor) {
        item.css('backgroundColor', 'transparent');
        if(edit)
            RemoveAbsence(absence);
    }
    else
    {
        item.css('backgroundColor', markColor);
        if(edit) {
            if (col == "#ffffff")
                AddAbsence(absence);
            else {
                absence = JSON.stringify(absence);
                removed.push(absence);
                added.push(absence);
            }
        }
    }
}

function DateToString(date) {

}

function getAbsenceId(color) {
    var id = 0;
    if (color == "#265a88") id = 1;//PN
    else if (color == "#419641") id = 2;    //ocr
    else if (color == "#2aabd2") id = 3;    //sluzobka
    else if (color == "#eb9316") id = 4;    //dovoleka
    else id = 5; //plan dovolenky
    return id;
}

function rgb2hex(rgb){
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}

function getDay(year, month, day){
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var date = new Date(year, month - 1, day);
    var day = date.getDay();
    return days[day];
}

function insert() {
    $.post("/uamt/intranet/attendance/php/insert.php", {data: JSON.stringify(convertBack(added))}, function (data, status) {
        console.log(status);
    })
}

function update() {
    $.post("/uamt/intranet/attendance/php/update.php", {data: JSON.stringify(convertBack(updated))}, function (data, status) {
        console.log(status);
    })
}

function deleteRecords() {
    $.post("/uamt/intranet/attendance/php/delete.php", {data: JSON.stringify(convertBack(removed))}, function (data, status) {
        console.log(status);
        insert();
    })
}

function convertBack(arr) {
    var tmp = [];
    for(var i = 0; i < arr.length; i++){
        tmp.push(JSON.parse(arr[i]));
    }
    return tmp;
}

var added = [];
var removed = [];
var updated = [];

function AddAbsence(absence) {
    absence = JSON.stringify(absence);
    removeFromAll(absence);
    added.push(absence);
}

function RemoveAbsence(absence){
    absence = JSON.stringify(absence);
    removeFromAll(absence);
    removed.push(absence);
}

function UpdateAbsence(absence){
    absence = JSON.stringify(absence);
    removeFromAll(absence);
    updated.push(absence);
}

function removeFromAll(absence) {
    var index = added.indexOf(absence);
    if(index > -1)
        added.splice(index, 1);
    index = removed.indexOf(absence);
    if(index > -1)
        removed.splice(index, 1);
    index = updated.indexOf(absence);
    if(index > -1)
        updated.splice(index, 1);
}

function printPDFTable(month, year, employees, employeesDays){
    var table = "<table id='tmpTable' style='border: 1px solid black;'>";
    var monthCount = getMonthDaysCount(month, year);

    for(var i = 0; i <= employees.length; i++) {
        if (i == 0)
            table += "<tr><th>Meno</th>";
        else
            table += "<tr><th>" + removeDiacritics(employees[i - 1]) + "</th>";
        for (var j = 1; j <= monthCount; j++) {
            var day = getDay(year, month, j);
            if (i == 0) {
                var insert = "";
                if (day == "Sun" || day == "Sat")
                    insert = "style='font-weight: bold;'";
                table += "<th " + insert + "> " + j + "</th>";
            }
            else {
                var name = employeesDays[employees[i - 1]];
                var letter = getAbsenceLetter(name[j - 1]);
                if (day == "Sun" || day == "Sat")
                    letter = 'X';
                table += "<td>" + letter + "</td>";
            }
        }
        if(i == 0){
            table += "<th>odpr</th><th>PN</th><th>O</th><th>S</th><th>D</th><th>P</th><th>SUM</th>"
        }
        else {
            table += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
        }
        table += "</tr>";
    }

    table += "</table>";
    var fuck = document.getElementById("toPrint");
    fuck.innerHTML = table;
    printPDF();
}

function getAndPrintPDFTable(month, year, doc) {
    $.post("/uamt/intranet/attendance/php/getAbsences.php", {'month' : month, 'year' : year, 'restrict': doc }, function (data, status) {
        data = JSON.parse(data);
        var names = data[0];
        var dictionary = data[1];
        var tmp = dictionary[names[0]];
        var down = false;
        printPDFTable(month, year, names, dictionary);
    });
}


// "what?" version ... http://jsperf.com/diacritics/12
function removeDiacritics (str) {
    str = str.replace('č', 'c');
    return str.replace('Ť', 'T');
}

function exportPDF(doc) {
    getAndPrintPDFTable(globalMonth, globalYear, doc);
}
function printPDF() {
    var doc = new jsPDF('landscape');
    var months = ['JANUÁR', 'FEBRUÁR', 'MAREC', 'APRÍL', 'MÁJ', 'JÚN', 'JÚL', 'AUGUST', 'SEPTEMBER', 'OKTÓBER', 'NOVEMBER', 'DECEMBER'];

    doc.setFontSize(8);
    doc.text('Slovenská technická univerzita Bratislava, Fakulta elektrotechniky a informatiky ', 15, 5);
    doc.text('Pracovisko: Ústav automobilovej mechatroniky', 15, 9);
    var textWidth = doc.getStringUnitWidth('EVIDENCIA DOCHÁDZKY') * doc.internal.getFontSize() / doc.internal.scaleFactor;
    var textOffset = (doc.internal.pageSize.width - textWidth) / 2;
    doc.text("Za mesiac: " + months[globalMonth - 1] + " " + globalYear, 15, 13);
    doc.text(textOffset, 17, 'EVIDENCIA DOCHÁDZKY');

    //doc.fromHTML($("#toPrint").get(0), 10, 17);
    var res = doc.autoTableHtmlToJson($("#tmpTable").get(0));

    doc.setFontSize(8);
    doc.autoTable(res.columns, res.data,
        {
            theme : 'grid',
            startY: 20,
            startX: 10,
            headerStyles: {fillColor: [206, 214, 226]},
            styles: {fontSize: 6/*, columnWidth: 'wrap', columnHeight: 'wrap'*/}// Red
        });

    doc.setFontSize(6);
    doc.text(15, doc.autoTable.previous.finalY + 4, 'Vysvetlivky: PN-práce neschopný, O-OCR, S-Služobná cesta, D-Dovolenka, P-Plán dovolenky');
    doc.setFontSize(8);
    doc.text(textOffset * 1.5, doc.autoTable.previous.finalY + 15, "prof. Ing. Mikuláš Huba, PhD.");
    doc.text(textOffset * 1.5 + 9, doc.autoTable.previous.finalY + 18, "riaditel ÚAMT");
    doc.text(25, doc.autoTable.previous.finalY + 11, "Vypracoval: Tvoj tatko generator");
    doc.save('dochadzka.pdf');
}

