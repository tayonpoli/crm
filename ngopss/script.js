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

