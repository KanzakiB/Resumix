//sidebar
window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
        sidebar.classList.remove('active');
    }
});     

//steps
document.addEventListener('DOMContentLoaded', function() {
    const stepButtons = document.querySelectorAll('.list-group-item-action[data-step]');
    const stepImage = document.getElementById('step-image');
    const stepImageContainer = document.getElementById('steps-image-container');
    const stepContents = {};

    for (let i = 1; i <= 5; i++) {
        stepContents[i] = document.getElementById(`step-content-${i}`);
        if (i > 1) {
            stepContents[i].classList.remove('mt-3');
        }
    }

    stepButtons.forEach(button => {
        button.addEventListener('click', function() {
            const stepNumber = this.getAttribute('data-step');

            Object.values(stepContents).forEach(content => {
                content.classList.add('collapse');
            });

            const currentContent = stepContents[stepNumber];
            if (currentContent) {
                currentContent.classList.remove('collapse');
            }

            switch (stepNumber) {
                case '1':
                    stepImage.src = 'http://localhost/Resumix/Images/step1.gif'; 
                    break;
                case '2':
                    stepImage.src = 'http://localhost/Resumix/Images/step2.gif'; 
                    break;
                case '3':
                    stepImage.src = 'http://localhost/Resumix/Images/step3.gif';
                    break;
                case '4':
                    stepImage.src = 'http://localhost/Resumix/Images/step4.gif';
                    break;
                case '5':
                    stepImage.src = 'http://localhost/Resumix/Images/step5.gif';
                    break;
                default:
                    stepImage.src = 'http://localhost/Resumix/Images/step1.gif';
                    break;
            }
        });
    });
});
