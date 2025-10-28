<?php
// Disable HTTP caching
header("Expires: Thu, 19 Nov 1969 08:52:00 GMT"); // Past date
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.1 (IE-specific)
header("Pragma: no-cache"); // HTTP/1.0
?>
  
document.addEventListener("DOMContentLoaded", function() {
    const copyButton = document.querySelector(".pocket-address-input .copy");
    const copyButtonRecipient = document.querySelector(".copy-recipient .copy");
    const copyDoneRecipient = document.querySelector(".copy-recipient .copy-done");
    const copyButtonAlias = document.querySelector(".recipient-alias-info .copy");
    const stepFormButtonSubmit = document.querySelector(".step-form-button-submit");
    const copyDone = document.querySelector(".pocket-address-input .copy-done");
    const copyDoneAlias = document.querySelector(".recipient-alias-info .copy-done");
    const inputField = document.getElementById("payment-id");
    const inputFieldAlias = document.getElementById("recipient-alias");
    const inputFieldRecipient = document.getElementById("recipient-name");
    
    const copyButtonCustomerBankReferenceCode = document.querySelector(".pocket-address-input-reference-code .copy");
    const copyDoneCustomerBankReferenceCode = document.querySelector(".pocket-address-input-reference-code .copy-done");
    
        copyButtonCustomerBankReferenceCode.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("input-reference-code").innerText).then(() => {
            copyButtonCustomerBankReferenceCode.style.display = "none";
            copyDoneCustomerBankReferenceCode.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerBankReferenceCode.style.display = "flex";
            copyDoneCustomerBankReferenceCode.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    
    const copyButtonCustomerBank = document.querySelector(".result-info-value-bank-name .result-info-value-copy");
    const copyDoneCustomerBank = document.querySelector(".result-info-value-bank-name .copy-done");
    
        copyButtonCustomerBank.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("customer-bank-name").innerText).then(() => {
            copyButtonCustomerBank.style.display = "none";
            copyDoneCustomerBank.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerBank.style.display = "flex";
            copyDoneCustomerBank.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    
    const copyButtonCustomerNumber = document.querySelector(".result-info-value-bank-number .result-info-value-copy");
    const copyDoneCustomerNumber = document.querySelector(".result-info-value-bank-number .copy-done");
    
            copyButtonCustomerNumber.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("customer-number").innerText).then(() => {
            copyButtonCustomerNumber.style.display = "none";
            copyDoneCustomerNumber.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerNumber.style.display = "flex";
            copyDoneCustomerNumber.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    
    const copyButtonCustomerRecipientName = document.querySelector(".result-info-value-recipient-name .result-info-value-copy");
    const copyDoneCustomerRecipientName = document.querySelector(".result-info-value-recipient-name .copy-done");
    
                copyButtonCustomerRecipientName.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("customer-name").innerText).then(() => {
            copyButtonCustomerRecipientName.style.display = "none";
            copyDoneCustomerRecipientName.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerRecipientName.style.display = "flex";
            copyDoneCustomerRecipientName.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    
    const copyButtonCustomerCode = document.querySelector(".result-info-value-reference-code .result-info-value-copy");
    const copyDoneCustomerCode = document.querySelector(".result-info-value-reference-code .copy-done");
    
                    copyButtonCustomerCode.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("order-id").innerText).then(() => {
            copyButtonCustomerCode.style.display = "none";
            copyDoneCustomerCode.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerCode.style.display = "flex";
            copyDoneCustomerCode.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    
    
    const copyButtonCustomerIban = document.querySelector(".pocket-address-input-iban .copy");
    const copyDoneCustomerIban = document.querySelector(".pocket-address-input-iban .copy-done");
    
        copyButtonCustomerIban.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("input-iban").innerText).then(() => {
            copyButtonCustomerIban.style.display = "none";
            copyDoneCustomerIban.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerIban.style.display = "flex";
            copyDoneCustomerIban.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    
    const copyButtonCustomerAmount = document.querySelector(".payment-form-amount .copy");
    const copyDoneCustomerAmount = document.querySelector(".payment-form-amount .copy-done");
    
        copyButtonCustomerAmount.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("customer-amount-number").innerText).then(() => {
            copyButtonCustomerAmount.style.display = "none";
            copyDoneCustomerAmount.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerAmount.style.display = "flex";
            copyDoneCustomerAmount.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    
    const copyButtonCustomerBankName = document.querySelector(".recipient-bank-name-input .copy");
    const copyDoneCustomerBankName = document.querySelector(".recipient-bank-name-input .copy-done");
    
        copyButtonCustomerBankName.addEventListener("click", function() {
        navigator.clipboard.writeText(document.getElementById("recipient-bank-name").innerText).then(() => {
            copyButtonCustomerBankName.style.display = "none";
            copyDoneCustomerBankName.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonCustomerBankName.style.display = "flex";
            copyDoneCustomerBankName.style.display = "none";
  }, 2000)
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });


setTimeout(() => {
                stepFormButtonSubmit.classList.add('active');
                stepFormButtonSubmit.removeAttribute("disabled");
            }, 30000);
            
    document.getElementById('btn-modal').addEventListener('click', function() {
        document.getElementById('overlay').classList.add('is-visible');
        document.getElementById('modal').classList.add('is-visible');
    });

    document.getElementById('btn-modal-next').addEventListener('click', function() {
        document.getElementById('overlay').classList.add('is-visible');
        document.getElementById('modal').classList.add('is-visible');
    });

    document.getElementById('close-btn').addEventListener('click', function() {
        document.getElementById('overlay').classList.remove('is-visible');
        document.getElementById('modal').classList.remove('is-visible');
    });
    document.getElementById('overlay').addEventListener('click', function() {
        document.getElementById('overlay').classList.remove('is-visible');
        document.getElementById('modal').classList.remove('is-visible');
    });
    
    const select = document.getElementById('selectBanks');
    const output = document.getElementById('customer-bank-name');

    select.addEventListener('change', function () {
      const selectedText = select.options[select.selectedIndex].text;
      output.textContent = selectedText;
    });
    
    const bankNumberInput = document.getElementById('step-info-bank-number');
const customerNumberDisplay = document.getElementById('customer-number');

if (bankNumberInput && customerNumberDisplay) {
  bankNumberInput.addEventListener('change', function () {
    customerNumberDisplay.textContent = this.value;
  });
}

    inputField.addEventListener("click", function() {
            stepFormButtonSubmit.classList.add('active');
                    stepFormButtonSubmit.removeAttribute("disabled");
        });
    copyButton.addEventListener("click", function() {
        navigator.clipboard.writeText(inputField.innerText).then(() => {
            copyButton.style.display = "none";
            copyDone.style.display = "flex";
            
              setTimeout(()=>{
    copyButton.style.display = "flex";
            copyDone.style.display = "none";
                }, 2000);

            setTimeout(() => {
                document.getElementById('step-form-button-submit').classList.add('active');
                document.getElementById('step-form-button-submit').removeAttribute("disabled");
            }, 1000);
        
			
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    copyButtonRecipient.addEventListener("click", function() {
        navigator.clipboard.writeText(inputFieldRecipient.innerText).then(() => {
            copyButtonRecipient.style.display = "none";
            copyDoneRecipient.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonRecipient.style.display = "flex";
            copyDoneRecipient.style.display = "none";
  }, 2000)

            setTimeout(() => {
                document.getElementById('step-form-button-submit').classList.add('active');
                document.getElementById('step-form-button-submit').removeAttribute("disabled");
            }, 1000);
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
    copyButtonAlias.addEventListener("click", function() {
        navigator.clipboard.writeText(inputFieldAlias.innerText).then(() => {
            copyButtonAlias.style.display = "none";
            copyDoneAlias.style.display = "flex";
            
              setTimeout(()=>{
    copyButtonAlias.style.display = "flex";
            copyDoneAlias.style.display = "none";
  }, 2000)

            setTimeout(() => {
                stepFormButtonSubmit.classList.add('active');
                stepFormButtonSubmit.removeAttribute("disabled");
            }, 1000);
        }).catch(err => {
            console.error("Error copying text: ", err);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("step-info-input");
    const inputTaxId = document.getElementById("step-info-input-tax-id");
    const stepInfoTaxId = document.querySelector(".customer-step-info-tax-id");
    const loader = document.querySelector(".customer-step-info-label svg");
    let stepInfo = document.querySelector(".customer-step-info-name");
    const error = document.querySelector(".error-message");
    const descriptionContainer = document.querySelector(".customer-step-info-description-container")[1];
    const stepFormButtonSubmitSave = document.getElementById("step-form-button-submit-save");
      const proof = document.getElementById('step-info-input-proof');

    function validateCuit(value) {
    const trimmed = value.trim();
    const regex = /^[A-Za-z0-9@.+-]{5,}$/;
    return regex.test(trimmed);
}

function checkCuit() {
  const input = document.getElementById('step-info-input-tax-id').value;
  const isValid = validateCuit(input);
  const stepFormButtonSubmitSave = document.getElementById("step-form-button-submit-save");
  const stepInfoTaxId = document.querySelector(".customer-step-info-tax-id");
  const proof = document.getElementById('step-info-input-proof');
  document.getElementById('customer-step-info-description-validation').textContent = isValid ? "Valid PayID" : "Invalid PayID";
  
  if (proof.files && proof.files.length > 0) {
                stepInfoTaxId.classList.add("correct");
                stepFormButtonSubmitSave.classList.add('active');
                stepFormButtonSubmitSave.removeAttribute("disabled");
            } else {
                stepFormButtonSubmitSave.classList.remove('active');
                stepFormButtonSubmitSave.setAttribute("disabled", "");
                stepInfoTaxId.classList.remove("correct");
            }
        
}
    
    stepFormButtonSubmitSave.addEventListener('click', function() {
     document.querySelector(".customer-step-info-description-container-success").style.display = "flex";
     input.setAttribute("readonly", "");
     input.classList.add("validation-success");
        stepFormButtonSubmitSave.classList.remove('active');
                stepFormButtonSubmitSave.setAttribute("disabled", "");
    });
    
    if(!stepInfo) {
        stepInfo = document.querySelector(".customer-step-info");
    }
    
    function isFirstCharLetter(str) {
    return /^[a-zA-Z]/.test(str);
}

    input.addEventListener("input", function () {
        loader.style.display = "flex";

        const inputValue = input.value.trim();
        const words = inputValue.split(/\s+/);

     
    });
    
    proof.addEventListener('change', () => {
     const input = document.getElementById('step-info-input-tax-id').value;
  const isValid = validateCuit(input);
    const stepFormButtonSubmitSave = document.getElementById("step-form-button-submit-save");
  if (proof.files && proof.files.length > 0) {
                stepFormButtonSubmitSave.classList.add('active');
                stepFormButtonSubmitSave.removeAttribute("disabled");
            } else {
                stepFormButtonSubmitSave.classList.remove('active');
                stepFormButtonSubmitSave.setAttribute("disabled", "");
            }
    });
    
    if(inputTaxId) {
        inputTaxId.addEventListener("input", function () {
    
            checkCuit();
         
        });
    }
});