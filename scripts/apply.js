

/* JavaScript for apply.html page */

// Function to validate date of birth and age
function validateDateOfBirth() {
    const dobInput = document.getElementById('dob');
    const dobValue = dobInput.value;
    const datePattern = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;

    if (!datePattern.test(dobValue)) {
        alert('Invalid date of birth. Please use the dd/mm/yyyy format.');
        dobInput.focus();
        return false;
    }

    const dobParts = dobValue.split('/');
    const day = parseInt(dobParts[0], 10);
    const month = parseInt(dobParts[1], 10);
    const year = parseInt(dobParts[2], 10);

    // Calculate age
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const age = currentYear - year;

    if (age < 15 || age > 80) {
        alert('Applicants must be between 15 and 80 years old.');
        dobInput.focus();
        return false;
    }
    return true;
}

// Function to validate state and postcode
function validateStateAndPostcode() {
    const stateSelect = document.getElementById('state');
    const postcodeInput = document.getElementById('postcode');
    const stateValue = stateSelect.value;
    const postcodeValue = postcodeInput.value;

    const statePostcodeMap = {
        VIC: /^(3|8)/,
        NSW: /^(1|2)/,
        QLD: /^(4|9)/,
        NT: /^0/,
        WA: /^6/,
        SA: /^5/,
        TAS: /^7/,
        ACT: /^0/,
    };

    if (!statePostcodeMap[stateValue] || !statePostcodeMap[stateValue].test(postcodeValue)) {
        alert('Invalid postcode for the selected state.');
        postcodeInput.focus();
        return false;
    }

    return true;
}

function validateSkills() {
    const skillCheckboxes = document.querySelectorAll('input[name="skills[]"]');
    let atLeastOneSkillSelected = false;

    skillCheckboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            atLeastOneSkillSelected = true;
        }
    });

    // check if at least one skill is selected
    if (!atLeastOneSkillSelected) {
        alert('Please select at least one skill.');
        return false;
    }

    // Check if "Other skills..." checkbox is selected
    const otherSkillsCheckbox = document.getElementById('otherSkills');
    const otherSkillsText = document.getElementById('otherSkillsText');
    if (otherSkillsCheckbox.checked && otherSkillsText.value.trim() === '') {
        alert('Please provide details for "Other Skills" since it is selected.');
        otherSkillsText.focus();
        return false;
    }
    return true;
}

// Function to validate the form before submission
function validateForm() {
    if (!validateDateOfBirth() || !validateStateAndPostcode() || !validateSkills()) {
        return false;
    }
    return true;
}

function storeApplicantsData() {

    // Store applicant's data for later submission
    localStorage.setItem('jobReference', document.getElementById('jobReference').value);
    localStorage.setItem('firstName', document.getElementById('firstName').value);
    localStorage.setItem('lastName', document.getElementById('lastName').value);
    localStorage.setItem('dob', document.getElementById('dob').value);
    localStorage.setItem('address', document.getElementById('address').value);
    localStorage.setItem('suburb', document.getElementById('suburb').value);
    localStorage.setItem('state', document.getElementById('state').value);
    localStorage.setItem('postcode', document.getElementById('postcode').value);
    localStorage.setItem('email', document.getElementById('email').value);
    localStorage.setItem('phone', document.getElementById('phone').value);
    localStorage.setItem('otherSkillsText', document.getElementById('otherSkillsText').value);

    // Store selected skills
    const skillCheckboxes = document.querySelectorAll('input[name="skills[]"]:checked');
    const selectedSkills = Array.from(skillCheckboxes).map((checkbox) => checkbox.value);
    localStorage.setItem('skills', JSON.stringify(selectedSkills));

    // Store selected gender
    const selectedGender = document.querySelector('input[name="gender"]:checked');
    if (selectedGender) {
        localStorage.setItem('gender', selectedGender.value);
    }
}

// Function to retrieve applicant's data from local storage and display it
function displayApplicantsData() {
    document.getElementById('jobReference').value = localStorage.getItem('jobReference')
    document.getElementById('firstName').value = localStorage.getItem('firstName')
    document.getElementById('lastName').value = localStorage.getItem('lastName')
    document.getElementById('dob').value = localStorage.getItem('dob')
    document.getElementById('address').value = localStorage.getItem('address')
    document.getElementById('suburb').value = localStorage.getItem('suburb')
    document.getElementById('state').value = localStorage.getItem('state')
    document.getElementById('postcode').value = localStorage.getItem('postcode')
    document.getElementById('email').value = localStorage.getItem('email')
    document.getElementById('phone').value = localStorage.getItem('phone')
    document.getElementById('lastName').value = localStorage.getItem('lastName')
    document.getElementById('otherSkillsText').value = localStorage.getItem('otherSkillsText')

    // Retrieve and set selected skills
    const selectedSkillsJSON = localStorage.getItem('skills');
    if (selectedSkillsJSON) {
        const selectedSkills = JSON.parse(selectedSkillsJSON);
        selectedSkills.forEach((skill) => {
            const skillCheckbox = document.getElementById(skill.toLowerCase());
            if (skillCheckbox) {
                skillCheckbox.checked = true;
            }
        });
    }

    // Retrieve and set selected gender
    const selectedGender = localStorage.getItem('gender');
    if (selectedGender) {
        const genderRadio = document.getElementById(selectedGender.toLowerCase());
        if (genderRadio) {
            genderRadio.checked = true;
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Get the form element by its ID
    displayApplicantsData();
    const applyForm = document.getElementById('applyForm');

    // Add an event listener for the "submit
    applyForm.addEventListener('submit', function () {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Call the validateForm function to perform form validation
        if (validateForm()) {
            // If validation succeeds, you can submit the form
            storeApplicantsData();
            applyForm.submit();
        }
    });
});


