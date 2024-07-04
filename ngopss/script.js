console.log("Script loaded");

const deliveryOptionMenu = document.getElementById("selectDelivery");
    const deliverySelectBtn = deliveryOptionMenu.querySelector(".select-btn");
    const deliveryOptions = deliveryOptionMenu.querySelectorAll(".option");
    const deliveryBtnText = deliveryOptionMenu.querySelector(".sBtn-text");
    const selectedDeliveryInput = document.getElementById("selectedDelivery");

    console.log(deliveryOptionMenu);

    deliverySelectBtn.addEventListener("click", () => {
        console.log("Delivery select button clicked");
        deliveryOptionMenu.classList.toggle("active");
    });

    deliveryOptions.forEach(option => {
        option.addEventListener("click", () => {
            console.log("Delivery option clicked");
            let selectedOption = option.querySelector(".option-text").innerText;
            deliveryBtnText.innerText = selectedOption;
            const deliveryFeeParagraph = document.getElementById("delfee");
            if (deliveryFeeParagraph) {
            deliveryFeeParagraph.innerText = "Rp. 15,000";
            }
            selectedDeliveryInput.value = selectedOption; // Set the value of the hidden input field
            deliveryOptionMenu.classList.remove("active");
        });
    });

    // JavaScript for the payment select menu
    const paymentOptionMenu = document.getElementById("selectPayment");
    const paymentSelectBtn = paymentOptionMenu.querySelector(".select-btn");
    const paymentOptions = paymentOptionMenu.querySelectorAll(".option");
    const paymentBtnText = paymentOptionMenu.querySelector(".sBtn-text");
    const selectedPaymentInput = document.getElementById("selectedPayment"); // Hidden input field

    paymentSelectBtn.addEventListener("click", () => {
        paymentOptionMenu.classList.toggle("active");
    });

    paymentOptions.forEach(option => {
        option.addEventListener("click", () => {
            let selectedOption = option.querySelector(".option-text").innerText;
            paymentBtnText.innerText = selectedOption;
            const paymentFeeParagraph = document.getElementById("payfee");
            if (paymentFeeParagraph) {
            paymentFeeParagraph.innerText = "Rp. 2,000";
            }
            selectedPaymentInput.value = selectedOption; // Set the value of the hidden input field
            paymentOptionMenu.classList.remove("active");
        });
    });

    const voucherOptionMenu = document.getElementById("selectVoucher");
    const voucherSelectBtn = voucherOptionMenu.querySelector(".select-btn");
    const voucherOptions = voucherOptionMenu.querySelectorAll(".option");
    const voucherBtnText = voucherOptionMenu.querySelector(".sBtn-text");
    const selectedVoucherInput = document.getElementById("selectedVoucher");
    const discountInput = document.getElementById("discountValue");
    const totalPriceElem = document.getElementById('totalPrice');
    const deliveryFeeElem = document.getElementById('deliveryFee');
    const serviceFeeElem = document.getElementById('serviceFee');
    const discountElem = document.getElementById('discount');
    const totalElem = document.getElementById('total');

    const totalPay = parseFloat(voucherOptionMenu.getAttribute('data-total-pay'));
    const deliveryFee = parseFloat(voucherOptionMenu.getAttribute('data-delivery-fee'));
    const serviceFee = parseFloat(voucherOptionMenu.getAttribute('data-service-fee'));
    const total = totalPay + deliveryFee + serviceFee;

    voucherSelectBtn.addEventListener("click", () => {
        voucherOptionMenu.classList.toggle("active");
    });

    voucherOptions.forEach(option => {
        option.addEventListener("click", () => {
            let selectedOption = option.querySelector(".option-text").innerText;
            voucherBtnText.innerText = selectedOption;

            selectedVoucherInput.value = selectedOption; // Set the value of the hidden input field
            
            // Apply discount and update total prices
            const discount = parseFloat(option.getAttribute('data-discount'));
            const discountAmount = totalPay * discount;
            const totalAfterDiscount = totalPay - discountAmount;
            const grandTotal = totalAfterDiscount + deliveryFee + serviceFee;

            totalPriceElem.textContent = `Rp. ${totalPay.toLocaleString()}`;
            discountElem.textContent = `- Rp. ${discountAmount.toLocaleString()}`;
            totalElem.textContent = `Rp. ${grandTotal.toLocaleString()}`;
            discountInput.value = discountAmount;

            voucherOptionMenu.classList.remove("active");
        });
    });

