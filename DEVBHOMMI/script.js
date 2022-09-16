$('#ripple').ripples({
	resolution: 512,
	dropRadius: 10,
	perturbance: 0.04,
});

var t = false;

login = () => {
    if (t) {
        document.getElementById('classic').style = "display:none";
        t = false;
    } else {
        document.getElementById('classic').style = "display:block";
        t = true;
    }
}

