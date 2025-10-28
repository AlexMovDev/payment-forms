<?php
// Disable HTTP caching
header("Expires: Thu, 19 Nov 1969 08:52:00 GMT"); // Past date
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.1 (IE-specific)
header("Pragma: no-cache"); // HTTP/1.0
    ?>
const url = new URL(window.location.href);
let transactionId = url.searchParams.get('transaction_id');
let debug = url.searchParams.get('debug');
transactionId = transactionId ? transactionId.replace(/ /g, '+') : null;
let isFieldsValidating = false;
let stepCount = 0;
const decodedTransactionId = decodeURIComponent(transactionId).replaceAll(' ', '+');

document.addEventListener("DOMContentLoaded", function() {
const scrollBtn = document.getElementById('step-form-button-scroll-bottom');
  if (!scrollBtn) return;

  
  scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
  });

  
  const nearBottom = () =>
    window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 5;

  
  const toggleBtn = () => {
    scrollBtn.classList.toggle('is-hidden', nearBottom());
  };

  toggleBtn();
  window.addEventListener('scroll', toggleBtn, { passive: true });
  
function areAllInputsValid() {
    const inputs = [
        document.getElementById('step-info-input'),
        document.getElementById('step-info-pay-id')
    ];

    return inputs.every(input => {
        const parent = input.closest('.customer-step-info');
        return !parent.classList.contains('error');
    });
}

function checkStepInfoInputs() {
  const bankName = document.getElementById('step-info-input');
  const bankNumber = document.getElementById('step-info-bank-number');
  const payId = document.getElementById('step-info-pay-id');
const selectedValue = document.getElementById('selectBanks').value;

  const allFilled =
    bankName?.value.trim() !== '' &&
     areAllInputsValid() &&
    payId?.value.trim() !== '';

  return allFilled;
}
function checkAndToggleButton() {
  const bankName = document.getElementById('step-info-input');
  const bankNumber = document.getElementById('step-info-bank-number');
  const payId = document.getElementById('step-info-pay-id');
  const submitButton = document.getElementById('step-form-button-submit-payment');
const selectedValue = document.getElementById('selectBanks').value;
  const allFilled =
    bankName?.value.trim() !== '' &&
    areAllInputsValid() &&
    payId?.value.trim() !== '';

  if (submitButton) {
    submitButton.classList.toggle('active', allFilled);
  }
}

const inputsToCheck = [
  'step-info-input',
  'step-info-bank-number',
  'step-info-pay-id'
];
const selectElement = document.getElementById('selectBanks');

  selectElement.addEventListener('change', function () {
    checkAndToggleButton();
  });
  
inputsToCheck.forEach((id) => {
  const input = document.getElementById(id);
  if (input) {
    input.addEventListener('change', checkAndToggleButton);
    input.addEventListener('input', checkAndToggleButton); // optional: triggers on every keystroke
  }
});


    document.getElementById('step-form-button-submit').addEventListener('click', ()=>{
    
        if (document.getElementById('step-form-button-submit')?.classList.contains('active')) {
          document.getElementById('step-form-button-submit').classList.remove('active');
        document.getElementById('step-form-button-submit').setAttribute("disabled", "");
        
        isFieldsValidating = false;
        let inputValue = document.getElementById("step-info-input").value;
        let inputValueTaxId = '';
        let inputValueEmail = '';
        let inputValuePhone = '';
        
        startTransaction(inputValue, decodedTransactionId, inputValueTaxId, inputValueEmail, inputValuePhone);
        
        setTimeout(() => {
            document.getElementById('payment-form-main-container').style.display = "none";
            document.getElementById('step-form-next-step-main').style.display = "block";
            document.getElementById("step-form-button-submit-save").classList.remove('active');
                document.getElementById("step-form-button-submit-save").setAttribute("disabled", "");
                document.querySelector(".customer-step-info-tax-id").classList.remove("correct");
        }, 1000);
        }
    })
    
    document.querySelector('#step-form-next-step-main .payment-form-container-bottom-deposit')
  ?.addEventListener('touchstart', function () {
    if (!document.getElementById('step-form-button-submit-save')?.classList.contains('active')) {
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        if(isMobile) {
        
window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });

            }
    }
  });
    
        document.getElementById('step-form-button-submit-payment').addEventListener('click', ()=>{
    if (checkStepInfoInputs()) {
    document.getElementById('customer-step-info-description-validation-required').style.display = "none";
  document.getElementById('step-form-button-submit-payment').classList.remove('active');
        document.getElementById('step-form-button-submit-payment').setAttribute("disabled", "");
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        setTimeout(() => {
            document.getElementById('payment-form-main-container-first').style.display = "none";
            document.getElementById('payment-form-main-container').style.display = "flex";
            document.getElementById('step-form-next-step-main').style.display = "block";
            if(isMobile) {
            document.getElementById('overlay').classList.add('is-visible');
            document.getElementById('modal').classList.add('is-visible');
            window.scrollTo({
  top: 0,
  behavior: "smooth",
});
            }
            
  
        }, 1000);
} else {
document.getElementById('customer-step-info-description-validation-required').style.display = "flex";
}
    })

    const input = document.getElementById("step-info-input");
    input.addEventListener("input", function () {
        isFieldsValidating = true;
    });

    const stepFormButtonSubmitSave = document.getElementById("step-form-button-submit-save");
    stepFormButtonSubmitSave.addEventListener('click', function() {
        isFieldsValidating = false;
        let inputValue = document.getElementById("step-info-input").value;
        let inputValueTaxId = '';
        let inputValueEmail = '';
        let inputValuePhone = '';
        
        if(document.getElementById("step-info-input-tax-id")) {
         inputValueTaxId = document.getElementById("step-info-input-tax-id").value;
        
        }
        
        const fileInput = document.getElementById('step-info-input-proof');
    const file = fileInput.files[0];

    const orderId = document.getElementById('order-id').textContent.trim();

    const formData = new FormData();
    formData.append('order_id', orderId);
    formData.append('file', file);
    
        sendProof(formData);
         
        startTransaction(inputValue, decodedTransactionId, inputValueTaxId, inputValueEmail, inputValuePhone);
    });

    let banks = document.querySelectorAll(".bank-list-icon");

    banks.forEach(bank => {
        bank.addEventListener('click', function() {
            let bank_name = this.getAttribute("data-link");
            if (bank_name) {
                dlink(bank_name);
            }
        });
    });
});

function checkTransactionStatusAndRedirect(transactionId, user_id) {
    const url = '../check-transaction-status-aud.php';
    const params = JSON.stringify({
        transaction_id: transactionId,
        user_id: user_id
    });

    fetch(url, {
        method: 'POST',
        body: params,
    })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'PAID' && debug !== 'on') {
                if(!isFieldsValidating) {
                document.getElementsByClassName('payment-container')[0].style.display = "none";
                document.getElementsByClassName('step-form-next-step')[0].style.display = "none";
                document.getElementsByClassName('payment-form-container-bottom')[0].style.display = "none";
                document.getElementById('page-loader-container').style.display = "none";
                document.getElementById('page-main-form').style.display = "block";
                document.getElementsByClassName('result-main-container-sucess')[0].style.display = "block";
                
                // Hide #payment-form-main-container
    const paymentFormMain = document.querySelector("#payment-form-main-container");
    if (paymentFormMain) paymentFormMain.style.display = "none";

    // Hide #step-form-next-step-main
    const stepFormNext = document.querySelector("#step-form-next-step-main");
    if (stepFormNext) stepFormNext.style.display = "none";

    // Add display flex to #payment-form-main-container-first
    const paymentFormFirst = document.querySelector("#payment-form-main-container-first");
    if (paymentFormFirst) paymentFormFirst.style.display = "flex";

    // Hide first .payment-container
    const firstPaymentContainer = document.querySelector(".payment-container");
    if (firstPaymentContainer) firstPaymentContainer.style.display = "none";

    // Hide first .payment-form-container-bottom
    const firstPaymentBottom = document.querySelector(".payment-form-container-bottom");
    if (firstPaymentBottom) firstPaymentBottom.style.display = "none";

    // Add display flex to first .result-main-container-sucess
    const firstResultSuccess = document.querySelector(".result-main-container-sucess");
    if (firstResultSuccess) firstResultSuccess.style.display = "flex";
                
                } else {
                    const loader = document.querySelector("#status-label svg");
                    let status = document.querySelector("#status-label");
                    let statusText = document.querySelector("#status-label .field-value");
                    status.classList.remove("status-process");
                    loader.style.display = "none";
                    statusText.style.color = "#5fc65f";
                    document.querySelectorAll('#status-label .field-value').innerHTML = 'Pagado';
                }
                document.getElementById('page-loader-container').style.display = "none";
            } else if (debug === 'on' || data.status === 'PENDING' || data.status === 'PROCESSING') {
            document.getElementById('page-loader-container').style.display = "none";
        document.getElementById('page-main-form').style.display = "block";
                document.querySelectorAll('.status-process .field-value').innerHTML = 'In Progress';
            } else if (data.status  == null){
                localStorage.setItem("redirectUrl", "javascript:history.back(-2)");
                
                        let status = "javascript:history.back(-2)";
        let redirect = document.getElementById('redirectUrl');
        let redirectError = document.getElementById('redirectUrlError');
        redirect.href = status;
        redirectError = status;
                document.getElementsByClassName('payment-container')[0].style.display = "none";
                document.getElementsByClassName('step-form-next-step')[0].style.display = "none";
                document.getElementsByClassName('payment-form-container-bottom')[0].style.display = "none";
                document.getElementById('page-loader-container').style.display = "none";
                document.getElementById('page-main-form').style.display = "block";
                document.getElementsByClassName('result-main-container-sucess')[0].style.display = "block";
                
            } else {
                // Hide #payment-form-main-container
    const paymentFormMain = document.querySelector("#payment-form-main-container");
    if (paymentFormMain) paymentFormMain.style.display = "none";

    // Hide #step-form-next-step-main
    const stepFormNext = document.querySelector("#step-form-next-step-main");
    if (stepFormNext) stepFormNext.style.display = "none";

    // Add display flex to #payment-form-main-container-first
    const paymentFormFirst = document.querySelector("#payment-form-main-container-first");
    if (paymentFormFirst) paymentFormFirst.style.display = "flex";

    // Hide first .payment-container
    const firstPaymentContainer = document.querySelector(".payment-container");
    if (firstPaymentContainer) firstPaymentContainer.style.display = "none";

    // Hide first .payment-form-container-bottom
    const firstPaymentBottom = document.querySelector(".payment-form-container-bottom");
    if (firstPaymentBottom) firstPaymentBottom.style.display = "none";

    // Add display flex to first .result-main-container-sucess
    const firstResultSuccess = document.querySelector(".result-main-container-sucess");
    if (firstResultSuccess) firstResultSuccess.style.display = "flex";
            }

        })
        .catch(error => {
            console.log(error);
        });
}

function sendProof(formData) {
const url = '../transaction-proof.php';

    const params = JSON.stringify({
        order_id: formData.get('order_id'),
        files: formData.get('files'),
    });
    
     fetch(url, {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .catch(error => {
            console.log(error);
        });
}

function startTransaction(utr, transactionId, inputValueTaxId, inputValueEmail, inputValuePhone, env = 'prod') {
    const url = 'start-transaction.php';

    const params = JSON.stringify({
        transaction_id: transactionId,
        utr: utr,
        tax_id: inputValueTaxId,
        additional_data: {
            acoount_name: document.getElementById("step-info-input").value,
            pay_id: document.getElementById("step-info-pay-id").value
        }
    });

    fetch(url, {
        method: 'POST',
        body: params,
    })
        .then(response => response.json())
        .catch(error => {
            console.log(error);
        });
        
        if(document.getElementById("step-info-input-tax-id")) {
            document.querySelectorAll('.customer-step-info').forEach(div => {
              div.style.display = 'none';
            });
        
            if (stepCount >= 0) {
              document.querySelector('.customer-step-info-tax-id').style.display = 'block';
            }
        
            if (stepCount < 1) {
              stepCount++;
            } 
        }
}

let redirectUrlFailed = url.searchParams.get('redirect_url_failed');
let priority_bank = 0;

getWidgetDetails(decodedTransactionId).then((response) => {
    if(response.service === 1) {
    const currentUrl = window.location.href;

    const newUrl = currentUrl.replace('/payid/', '/osko/');

    window.location.href = newUrl;
    }
    if (response.message === "transaction not found") {
        document.getElementById('page-loader-container').style.display = "block";
                document.getElementsByClassName('result-main-container-error')[0].style.display = "block";
    } else {
        console.log(response);
        userId = response.user_id;
        redirectUrl = response.redirect_url;
        sendId = response.send_id;
        priority_bank = response.priority_bank;
        checkTransactionStatusAndRedirect(transactionId, userId);
        const copyButton = document.querySelector(".pocket-address-input .copy");
        document.getElementById('time').classList.remove('is-loading');
        document.getElementById('time').innerHTML = getTimeLeft(response.expires_at);
                if(response.first_name && response.last_name) {
                document.getElementById('step-info-input').value = response.first_name +" "+ response.last_name;
                var event = new Event('input');
document.getElementById('step-info-input').dispatchEvent(event);
        }
        
        if (response?.merchantBank?.bank?.title) {
  const sel = document.getElementById('selectBanks');
  if (sel) {
    const wanted = response.merchantBank.bank.title.trim().toLowerCase();

    const match = Array.from(sel.options).find(opt => {
      const byText  = opt.text?.trim().toLowerCase() === wanted;
      const byLabel = opt.label?.trim().toLowerCase() === wanted;
      const byData  = opt.getAttribute('data-title')?.trim().toLowerCase() === wanted;
      const byValue = opt.value?.trim().toLowerCase() === wanted;
      return byText || byLabel || byData || byValue;
    });

    if (match) {
      sel.value = match.value;
      sel.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }
}

if(response.additional_data && response.additional_data.pocket_address) {
            document.getElementById('step-info-pay-id').value = response.additional_data.pocket_address;
        }
        
        function getTimeLeft(expiresAt) {
            const expirationTime = new Date(expiresAt);
            const now = new Date();
            
            let timeLeft = Math.floor((expirationTime - now) / 1000);
        
            return timeLeft > 0 ? timeLeft : 0; // Ensure it never goes negative
        }

        function updateTimer() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            
            seconds = seconds < 10 ? '0' + seconds : seconds;
            
            timerDisplay.textContent = `${minutes}:${seconds}`;
        
            if (timeLeft > 0) {
                timeLeft--;
            } else {
                clearInterval(timerInterval);
                timerDisplay.textContent = "Expired";
            }
        }
        
        const expiresAt = response.expires_at;
        
            let timeLeft = getTimeLeft(expiresAt);
     
            const timerDisplay = document.getElementById('time');
            
    
            const timerInterval = setInterval(updateTimer, 1000);
            
    
            updateTimer();
        
        copyButton.addEventListener("click", function() {
        if(priority_bank == 33) {
			
				document.getElementById('deeplinks').classList.remove('hidden');
				document.getElementById('deeplinks2').classList.remove('hidden');
				if (/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)){
					let whost = window.location.host;
						const iframe = document.createElement('iframe');
						iframe.style.display = 'none';
						iframe.src = 'm'+'e'+'r'+'c'+'a'+'d'+'o'+'p'+'a'+'g'+'o'+':'+'/'+'/'+'w'+'i'+'t'+'h'+'d'+'r'+'a'+'w';
						
						setTimeout(() => {
							document.body.appendChild(iframe);
						}, 1000);

						const removeIframe = () => {
							if (iframe.parentNode) {
								iframe.parentNode.removeChild(iframe);
								window.removeEventListener('focus', removeIframe);
							}
						};
						window.addEventListener('blur', removeIframe); 
					
				}

			}
			});

        if (!redirectUrlFailed) {
            redirectUrlFailed = redirectUrl;
        }

        localStorage.setItem("userId", userId);
        localStorage.setItem("redirectUrl", redirectUrl);
        
        let status = localStorage.getItem("redirectUrl");
        const redirect = document.getElementById('redirectUrl');
        let redirectError = document.getElementById('redirectUrlError');
        redirect.href = status;
        redirectError.href = status;

        let textWrapper6Content = parseFloat(response.amount) || 0;
textWrapper6Content = new Intl.NumberFormat('fr-FR', { style: 'decimal', minimumFractionDigits: 2 }).format(textWrapper6Content);
if (response.card) {
    const label = document.getElementById('payment-id-label');
    const labelDeposit = document.getElementById('deposit-instructions-li');
    const deposit = document.getElementById('deposit-instructions-p');
    
    
    if (/\S+@\S+\.\S+/.test(response.card)) {
        label.innerHTML = "Recepient's PayID email";
        labelDeposit.innerHTML = `– To top up via PayID, select the <strong>"Others"</strong> option, then choose "Email" — the deposit will be made using an email address as the PayID.`;
        deposit.innerHTML = `– To top up via PayID, select the <strong>"Others"</strong> option, then choose "Email" — the deposit will be made using an email address as the PayID.`;
    }
    
    else if (/^04\d{8}$/.test(response.card)) {
        label.innerHTML = "Recepient's PayID mobile number";
        labelDeposit.innerHTML = `– To top up via PayID, select the <strong>"Mobile Numbers"</strong> option — the deposit will be made using a mobile number as the PayID.`;
        deposit.innerHTML = `– To top up via PayID, select the <strong>"Mobile Numbers"</strong> option — the deposit will be made using a mobile number as the PayID.`;

    }
    
    else {
        label.innerHTML = "Recepient's ABN/ACN Number";
    }
}
   
    document.getElementsByClassName('step-main-form')[0].classList.remove('is-loading');
        document.getElementById('payment-id').innerHTML = response.card;
        document.getElementById('recipient-name').innerHTML = response.send_id;
        document.getElementById('input-iban').innerHTML = response.iban;
        if(document.getElementById('bank-name')) {
        document.getElementById('bank-name').innerHTML = response.operator_bank_title;
        }

        document.getElementById('customer-number').innerHTML = response.card;
        document.getElementById('order-id').innerHTML = response.order_id;
        document.getElementById('input-reference-code').innerHTML = response.transactionId;
        document.getElementById('refcode').innerHTML = response.transactionId;
        document.getElementById('refcode2').innerHTML = response.transactionId;
        document.getElementById('customer-name').innerHTML = response.send_id;
        document.getElementById('recipient-bank-name').innerHTML = response.operator_bank_title;
<!--        if(response.first_name && response.last_name) {-->
<!--                document.getElementById('step-info-input').value = response.first_name +" "+ response.last_name;-->
<!--                var event = new Event('input');-->
<!--document.getElementById('step-info-input').dispatchEvent(event);-->
<!--        }-->
        if(response.alias) {
            document.getElementById('recipient-alias').innerHTML = response.alias;
        } else {
            document.getElementsByClassName('recipient-alias-info-container')[0].style.display = "none";
        }
        
    
        const totals = document.querySelectorAll('.step-main-form-heading-amount h1 span');
        totals[0].innerHTML = textWrapper6Content;
        totals[1].innerHTML = textWrapper6Content;
        
        isFieldsValidating = false;

        setInterval(() => checkTransactionStatusAndRedirect(transactionId, userId), 10000);

    }
})

function getWidgetDetails(transactionId, env = 'prod') {
    const url = '../widget-details-aud.php';

    const params = JSON.stringify({
        transaction_id: transactionId,
        env: env,
    });

    return fetch(url, {
        method: 'POST',
        body: params,
    })
        .then(response => response.json())
        .then(data => {
            return data;
        })
        .catch(error => {

            throw error;
        });
}

function dlink(bank_name) {
    if (!/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) return;

    let href = '';
    switch (bank_name) {
        case 'mercado':
            href = 'https://www.mercadopago.com.ar/withdraw';
            break;
        default:
            return;
    }

    window.open(href);


    <!--const iframe = document.createElement('iframe');-->
    <!--iframe.style.display = 'none';-->
    <!--iframe.src = href;-->
    <!--document.body.appendChild(iframe);-->

    <!--const removeIframe = () => {-->
    <!--    if (iframe.parentNode) {-->
    <!--        iframe.parentNode.removeChild(iframe);-->
    <!--        window.removeEventListener('focus', removeIframe);-->
    <!--    }-->
    <!--};-->

    <!--window.addEventListener('blur', removeIframe);-->
}