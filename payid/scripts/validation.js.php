<?php
// Disable HTTP caching
header("Expires: Thu, 19 Nov 1969 08:52:00 GMT"); // Past date
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.1 (IE-specific)
header("Pragma: no-cache"); // HTTP/1.0
?>
// Utility functions for validation
function isValidFullName(name) {
    const words = name.trim().split(/\s+/);
    return /^[A-Za-z]/.test(name) && words.length >= 2;
}

function isValidBankAccountNumber(number) {
 const isValid = /^\d{6,12}$/.test(number);
    return isValid;
}

function isValidPayID(payid) {
    const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(payid);
    const isMobile = /^(\+?61|0)[2-478]\d{8}$/.test(payid); // Australian mobile
    const isABN = /^\d{11}$/.test(payid); // ABN is 11 digits
    return isEmail || isMobile || isABN;
}

function isValidBSBPayID(payid) {
    const isValid = /^\d{6,}$/.test(payid);
    return isValid;
}

// Main validation function
function validateInput(input, isValidFn) {
    const parent = input.closest('.customer-step-info');
    if (!isValidFn(input.value.trim())) {
        parent.classList.add('error');
    } else {
        parent.classList.remove('error');
    }
}

function isValidTaxID(value) {
    const trimmed = value.trim();
    const regex = /^[A-Za-z0-9@.+-]{5,}$/;
    return regex.test(trimmed);
}

// Bind validation to inputs on both 'input' and 'change'
document.addEventListener('DOMContentLoaded', () => {
    const fullNameInput = document.getElementById('step-info-input');
    const bankNumberInput = document.getElementById('step-info-bank-number');
    const payIdInput = document.getElementById('step-info-pay-id');
    const taxIdInput = document.getElementById('step-info-input-tax-id');


    const attachValidation = (input, validator) => {
        input.addEventListener('input', () => validateInput(input, validator));
        input.addEventListener('change', () => validateInput(input, validator));
    };

    attachValidation(fullNameInput, isValidFullName);
    attachValidation(payIdInput, isValidPayID);

});
