// script.js
let monthYearElem = document.getElementById('month-year');
let daysContainerElem = document.getElementById('days-container');

let currentDate = new Date();
let currentMonth = currentDate.getMonth() + 1;
let currentYear = currentDate.getFullYear();

displayCalendar(currentMonth, currentYear);

function displayCalendar(month, year) {
    monthYearElem.textContent = getMonthName(month) + ' ' + year;
    daysContainerElem.innerHTML = '';

    let firstDayOfMonth = new Date(year, month - 1, 1);
    let lastDayOfMonth = new Date(year, month, 0);
    let numDays = lastDayOfMonth.getDate();

    let startingDay = firstDayOfMonth.getDay();

    for (let i = 0; i < startingDay; i++) {
        let blankDay = document.createElement('div');
        blankDay.classList.add('calendar-day');
        daysContainerElem.appendChild(blankDay);
    }

    for (let i = 1; i <= numDays; i++) {
        let dayElem = document.createElement('div');
        dayElem.textContent = i;
        dayElem.classList.add('calendar-day');
        if (i === currentDate.getDate() && month === currentDate.getMonth() + 1 && year === currentDate.getFullYear()) {
            dayElem.classList.add('today');
        }
        dayElem.setAttribute('onclick', `openEventForm(${i}, ${month}, ${year})`);
        daysContainerElem.appendChild(dayElem);
    }
}

function previousMonth() {
    currentMonth--;
    if (currentMonth < 1) {
        currentMonth = 12;
        currentYear--;
    }
    displayCalendar(currentMonth, currentYear);
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 12) {
        currentMonth = 1;
        currentYear++;
    }
    displayCalendar(currentMonth, currentYear);
}

function getMonthName(month) {
    let monthNames = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    return monthNames[month - 1];
}

function openEventForm(day, month, year) {
    window.location.href = `../frmEvento.php?day=${day}&month=${month}&year=${year}`;
}
