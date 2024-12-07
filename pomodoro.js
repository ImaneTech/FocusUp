// ----------------------------------------  pour recuperer les elements pour controler le minuteur Pomodoro
const start = document.getElementById("start");
const pause = document.getElementById("pause");
const reset = document.getElementById("reset");
const timer = document.getElementById("timer");

// ----------------------------------------  pour definir le temps initial du minuteur  
let timeleft = 1500;   // 25 minutes en secondes
let timerInterval;

// ----------------------------------------  pour mettre a jour l'affichage du minuteur
const updateTimer = () => {
    const minutes = Math.floor(timeleft / 60);
    const seconds = timeleft % 60;
    // ----------------------------------------  pour formater les minutes et secondes avec des zeros non significatifs
    timer.innerHTML = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}   

// ----------------------------------------  pour demarrer le minuteur   
const startTimer = () => {
    // ----------------------------------------  pour definir l'intervalle de mise a jour du minuteur
    timerInterval = setInterval(() => {
        timeleft--;
        updateTimer();
        if (timeleft === 0) {
            // ----------------------------------------  pour arreter l'intervalle et afficher un message
            clearInterval(timerInterval);
            // ----------------------------------------  pour afficher un message de fin
            alert("Le temps est terminé !");
            // ----------------------------------------  pour reinitialiser le minuteur
            timeleft = 1500;
            updateTimer();
        }
    }, 1000);

};

// ----------------------------------------  pour arreter le minuteur   
const pauseTimer = () => {
    clearInterval(timerInterval);   //
}


// ----------------------------------------  pour reinitialiser le minuteur   
const resetTimer = () => {
    clearInterval(timerInterval);
    timeleft = 1500;   // 25 minutes en secondes    
    updateTimer();
}


// ----------------------------------------  pour ajouter des evenements aux boutons
start.addEventListener("click", startTimer);
pause.addEventListener("click", pauseTimer);
reset.addEventListener("click", resetTimer);    

