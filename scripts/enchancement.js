
/* applied on job.html page to save jobreference in localStorage */
// Event listener for job application links
document.addEventListener('DOMContentLoaded', function () {
    const applyLinks = document.querySelectorAll('.apply-link');
    applyLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            // Get the job reference number from the data attribute
            const jobReference = link.getAttribute('data-job-reference');
            // Store the job reference number in local storage
            localStorage.setItem('jobReference', jobReference);
            // Redirect to the apply.html page
            window.location.href = 'apply.html';
        });
    });
});


var index = 0;

function slideShow() {
    setTimeout(slideShow, 2000);
    var slide;
    const slides = document.querySelector('img');
    for (slide = 0; slide < slides.length; slide++) {
        slides[slide].style.display = 'none';
    }
    index++;
    if (index > slides.length) {
        index = 1;
    }
    slides[index - 1].style.display = 'block';
}

slideShow()