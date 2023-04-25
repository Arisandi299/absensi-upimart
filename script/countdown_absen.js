export function countdown (end){
    setInterval(() => {
        let now = new Date().getTime();
        let distance = end - now;
    
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // console.log(hours, " ", minutes, " ", seconds)
        console.log(distance);

        if(distance < 0){
            clearInterval();
        }

    }, 1000);
    

}