const now= new Date();

const today={
    year: now.getFullYear(),
    date: now.getDate(),
    mouth: now.toLocaleString('en-US', {month: 'short'}),
    day: now.toLocaleString('en-US', {weekday: 'short'})
}

for(let key in today){
    document.getElementById(key).textContent=today(key);
}