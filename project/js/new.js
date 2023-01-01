function change(){
    $('h1').html("This will change after 3 seconds.");
}

setTimeout(() => {
    change();
}, 3000);