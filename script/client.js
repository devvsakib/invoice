$(document).ready(function () {
    let totalPrice = 0;

    let thisBtn;
    $('.price-input').each(function () {
        let price = parseFloat($(this).val());
        let quantity = parseFloat($(this).closest('tr').find('.quantity-select').val());
        totalPrice += price * quantity;
    });
    $('#subtotalPrice').text(totalPrice.toFixed(2) + " EUR");

    $(document).on('change', '.quantity-select', function () {
        calculateTotalPrice();
    });

    // Event listener for price input change
    $(document).on('change', '.price-input', function () {
        calculateTotalPrice();
    });

    function calculateTotalPrice() {
        totalPrice = 0;
        $('.price-input').each(function () {
            let price = parseFloat($(this).val());
            let quantity = parseFloat($(this).closest('tr').find('.quantity-select').val());
            totalPrice += price * quantity;
        });
        $('#subtotalPrice').text(totalPrice.toFixed(2) + " EUR");
    }


    $(document).on('click', '.discount-btn', function (event) {
        $('.dropdown').toggle();
        thisBtn = $(this);
        let buttonPosition = $(this).offset();
        let buttonHeight = $(this).outerHeight();
        let topPosition = buttonPosition.top + buttonHeight;
        let leftPosition = buttonPosition.left - 300;
        $('.dropdown').css({
            top: topPosition,
            left: leftPosition
        });
        event.stopPropagation();
    });
    let dropdown = $(".dropdown");

    $(".discount-btn").click(function () {
        $(".dropdown").toggle(); // Hide any open menus
        let priceInput = $(this).closest("tr").find(".price-input");
        dropdown.data("priceInput", priceInput);
        dropdown.hide(); // Toggle the visibility of the dropdown
    });

    $(".save-btn").click(function () {
        let discountType = dropdown.find('.select-des option:selected').val();
        let discountValue = parseFloat(dropdown.find('.input-des').val());

        // check if discount value is valid
        if (discountType === '') {
            alert('Please select a discount type.');
            return;
        }
        if (discountValue === '') {
            alert('Please enter a discount value.');
            return;
        }
        if (discountType === 'percentage' && (discountValue < 0 || discountValue > 100)) {
            alert('Please enter a valid discount percentage.');
            return;
        }
        if (discountType === 'fixed' && discountValue < 0) {
            alert('Please enter a valid discount value.');
            return;
        }
        // check if discount value is number or not
        if (isNaN(discountValue)) {
            alert('Please enter a valid discount value.');
            return;
        }

        let removeDiscount = thisBtn.closest("tr").find(".removeDiscount");
        removeDiscount.removeClass("d-none");
        let priceInput = thisBtn.closest("tr").find(".price-input");
        let price = parseFloat(priceInput.val());
        let discountedPrice = 0;

        if (discountType === 'fixed') {
            discountedPrice = price - parseFloat(discountValue);
        } else if (discountType === 'percentage') {
            let discountPercentage = parseFloat(discountValue);
            discountedPrice = price - (price * (discountPercentage / 100));
        }


        priceInput.val(discountedPrice.toFixed(2) || '');

        let actualPrice = price.toFixed(2) + " EUR";
        let deductedPrice = (price - discountedPrice).toFixed(2) + " EUR";

        let $totalPrice = priceInput.closest('td.totalPrice');
        $totalPrice.find('.actual-price').text(actualPrice);
        $totalPrice.find('.discounted-price').text(discountedPrice.toFixed(2) + " EUR");
        $totalPrice.find('.deducted-price').text("- " + deductedPrice);
        $totalPrice.find('.discount-btn').hide();

        priceInput.closest('tr').find('.discount-btn').hide();
        priceInput.hide()
        calculateTotalPrice()
        // clear the dropdown
        dropdown.find('.input-des').val('');
        dropdown.hide(); // Hide the dropdown after saving
    });
    $(document).on('click', '.removeDiscount', function () {
        let $row = $(this).closest('tr');
        let originalPrice = $row.find('.actual-price').text();
        let discountBTN = $row.find('.discount-btn');
        let totalPriceInput = $row.find('.price-input');

        // Update the price input value to the original price
        totalPriceInput.css('display', '');
        discountBTN.toggle()
        totalPriceInput.val(originalPrice);

        $row.find('.actual-price').text('');
        $row.find('.deducted-price').text('');
        $row.find('.discounted-price').text('');
        calculateTotalPrice();
        $(this).hide();
    });

    $(document).click(function () {
        $('.dropdown').hide();
    });

    $('.dropdown').click(function (event) {
        event.stopPropagation();
    });

    $(document).on('click', '.deleteRow', function () {
        $(this).closest('tr').remove();
        calculateTotalPrice();
    });

    $(document).on('click', '.productBtn', function () {
        let rowHtml = `
        <tr>
        <td class="text-right pLeft quant">
            <label class="custom-select">
                <select class="quantityOther quantity-select">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </label>
        </td>
        <td class="text-center">
            <label class="custom-select">
                <select class="other-select-des productInp service-select">
                    <option default value="">Select product/item</option>
                    <option value="Services">Services 1</option>
                    <option value="Services" default>Services 2</option>
                </select>
            </label>
        </td>
        <td class="text-center">
            <label class="custom-select">
                <select class="other-select-des duration-select">
                    <option value="2">2h</option>
                    <option value="3">3h</option>
                </select>
            </label>
            <label class="custom-select">
                <select class="other-select-des duration-minute-select">
                    <option value="30">30m</option>
                    <option value="45">45m</option>
                </select>
            </label>
        </td>
        <td colspan="2" class="text-center position-relative totalPrice ">
            <span class="discount-btn otherBTN">Discount</span>
            <input class="other-select-des-input price-input original-price" type="text" placeholder="Price" value="30">
    
            <div class="text-end ddt">
                <div class="w-75">
                    <p class="text-right" style="margin-bottom: 0;"><span
                            class="actual-price"></span>
                        <span class="discounted-price"></span>
                    </p>
                    <div>
                        <span class="deducted-price"></span>
                        <button title="Remove Discount?"
                            class="removeDiscount d-none"><img
                            src="./cross.svg" /></button>
                </div>
            </div>
        </div>
        </td>
        <td class="text-end pLeft">
            <span class="deleteRow">
                <img src="./trash.svg" alt="">
            </span>
        </td>
    </tr>
        `;
        $('.table-body').append(rowHtml);
        $('.custom-select').each(function () {
            setupSelector(this);
        });
    });

    $(document).on('click', '.serviceBtn', function () {
        let rowHtml = `<tr>
        <td class="text-right pLeft quant">
            <label class="custom-select">
                <select class="quantityOther quantity-select">
                    <option value="1">Select</option>
                    <option value="1" default>1</option>
                    <option value="2">2</option>
                </select>
            </label>
        </td>
        <td class="text-center">
            <label class="custom-select">
                <select class="other-select-des supsurvice service-select">
                    <option default>Select Subservice</option>
                    <option value="Services">Services 1</option>
                    <option value="Services" default>Services 2</option>
                </select>
            </label>
        </td>
        <td class="text-center">
            <label class="custom-select">
                <select class="other-select-des duration-select">
                    <option value="2">2h</option>
                    <option value="3">3h</option>
                </select>
            </label>
            <label class="custom-select">
                <select class="other-select-des duration-minute-select">
                    <option value="30">30m</option>
                    <option value="45">45m</option>
                </select>
            </label>
        </td>
        <td colspan="2" class="text-center position-relative totalPrice ">
            <span class="discount-btn otherBTN">Discount</span>
            <input class="other-select-des-input price-input original-price" type="text"
                placeholder="Price" value="30">

            <div class="text-end ddt">
                <div class="w-75">
                    <p class="text-right" style="margin-bottom: 0;"><span
                            class="actual-price"></span>
                        <span class="discounted-price"></span>
                    </p>
                    <div>
                        <span class="deducted-price"></span>
                        <button title="Remove Discount?"
                            class="removeDiscount d-none"><img
                                src="./cross.svg" /></button>
                    </div>
                </div>
            </div>
        </td>
        <td class="text-end pLeft">
            <span class="deleteRow">
                <img src="./trash.svg" alt="">
            </span>
        </td>
    </tr>`;
        $('.table-body').append(rowHtml);
        $('.custom-select').each(function () {
            setupSelector(this);
        });
    });

    $(document).on('click', '.otherBtn', function () {
        let rowHtml = `<tr>
        <td class="text-right pLeft quant">
            <label class="custom-select">
                <select class="quantityOther quantity-select">
                    <option value="1">Select</option>
                    <option value="1" default>1</option>
                    <option value="2">2</option>
                </select>
            </label>
        </td>
        <td class="text-center">
            <input class="other-select-des-input otherInput text-center  custom-placeholder" type="text"
                placeholder="Input">
        </td>
        <td class="text-center">
            <label class="custom-select">
                <select class="other-select-des duration-select">
                    <option value="2">2h</option>
                    <option value="3">3h</option>
                </select>
            </label>
            <label class="custom-select">
                <select class="other-select-des duration-minute-select">
                    <option value="30">30m</option>
                    <option value="45">45m</option>
                </select>
            </label>
        </td>
        <td colspan="2" class="text-center position-relative totalPrice ">
            <span class="discount-btn otherBTN">Discount</span>
            <input class="other-select-des-input price-input original-price" type="text" placeholder="Price" value="30">
    
            <div class="text-end ddt">
            <div class="w-75">
                <p class="text-right" style="margin-bottom: 0;"><span
                        class="actual-price"></span>
                    <span class="discounted-price"></span>
                </p>
                <div>
                    <span class="deducted-price"></span>
                    <button title="Remove Discount?"
                        class="removeDiscount d-none"><img
                            src="./cross.svg" /></button>
                </div>
            </div>
        </div>
        </td>
        <td class="text-end pLeft">
            <span class="deleteRow">
                <img src="./trash.svg" alt="">
            </span>
        </td>
    </tr>`;
        $('.table-body').append(rowHtml);
        $('.custom-select').each(function () {
            setupSelector(this);
        });
    });

    $('#save').click(function () {
        totalPrice = 0;

        $('.price-input').each(function () {
            let price = parseFloat($(this).val());
            let quantity = parseFloat($(this).closest('tr').find('.quantity-select').val());
            totalPrice += price * quantity;
        });

        $('.subtotalPrice').text(totalPrice.toFixed(2) + " EUR");

        // Create client information object
        let clientInfo = {
            serviceDate: $('.detailsLeft').find('span.text-muted:eq(0)').text(),
            displayName: $('.detailsLeft').find('span.text-muted:eq(1)').text(),
            legalName: $('.detailsLeft').find('span.text-muted:eq(2)').text(),
            professionalAddress: $('.detailsLeft').find('span.text-muted:eq(3)').text(),
            professionalVATNo: $('.detailsLeft').find('span.text-muted:eq(4)').text(),
            professionalCOCNo: $('.detailsLeft').find('span.text-muted:eq(5)').text(),
            invoiceDate: $('.text-sm-end').find('span.text-muted').text(),
        };
        let items = [];

        // Iterate through each row in the table
        let isValid = true;
        $('.table-body tr').each(function () {
            let $row = $(this);
            let quantity = $row.find('.quantityOther').val();
            let description = $row.find('.other-select-des.service-select').val();
            let durationHours = $row.find('.duration-select').val();
            let durationMinutes = $row.find('.duration-minute-select').val();
            let price = $row.find('.price-input').val();

            // Validate required fields
            if (quantity === '' || description === '' || durationHours === '' || durationMinutes === '' || price === '') {
                $row.addClass('error');
                isValid = false;
                return; // Exit the loop if there is an error
            }

            // Create duration string
            let duration = '';
            if (durationHours !== '0') {
                duration += durationHours + 'h ';
            }
            if (durationMinutes !== '0') {
                duration += durationMinutes + 'm';
            }

            // Create item object
            let item = {
                quantity: quantity,
                description: description,
                duration: duration,
                price: price + ' EUR',
            };

            // Add item to the array
            items.push(item);
        });

        // Check if validation failed
        if (!isValid) {
            alert('Please fill in all required fields.');
            return;
        }

        // Create final JSON object
        let data = {
            client: clientInfo,
            item: items,
        };

        // Update table display
        $('.table-body tr').each(function () {
            $(this).find('td').each(function () {
                let $td = $(this);
                let $select = $td.find('select');
                let $input = $td.find('input');

                if ($select.length) {
                    let selectedOption = $select.find('option:selected').text();
                    $td.text(selectedOption);
                }
                // if there is td text only, skip
                if ($td.text().length > 1 && $td.text().indexOf('EUR') > -1) {
                    $td.removeClass('extraMargin')
                    return;
                }

                if ($input.length) {
                    let inputValue = $input.val() + ' EUR';
                    $td.text(inputValue);
                }

                if ($td.hasClass('duration-select')) {
                    // Add space between hours and minutes
                    let durationText = $td.text();
                    durationText = durationText.replace(/(\d+)h(\d+)m/, '$1h $2m');
                    $td.text(durationText);
                }
            });
        });
        $('.btns-group').addClass('d-none');
        $('#save').addClass('d-none');
        $('.discount-btn2').addClass('d-none');
        $('.table-body td.text-end.pLeft').remove();
        let removeDiscount = thisBtn.closest("tr").find(".removeDiscount");
        removeDiscount.addClass("d-none");
        // Print the JSON object in the console
        console.log(data);

    });
});

$('.custom-select').each(function () {
    setupSelector(this);
});

function setupSelector(selector) {
    selector.addEventListener('change', e => {
        console.log('changed', e.target.value)
    })

    selector.addEventListener('mousedown', e => {
        if (window.innerWidth >= 420) {// override look for non mobile
            e.preventDefault();

            const select = selector.children[0];
            const dropDown = document.createElement('ul');
            dropDown.className = "selector-options";

            [...select.children].forEach(option => {
                const dropDownOption = document.createElement('li');
                dropDownOption.textContent = option.textContent;

                dropDownOption.addEventListener('mousedown', (e) => {
                    e.stopPropagation();
                    select.value = option.value;
                    selector.value = option.value;
                    select.dispatchEvent(new Event('change'));
                    selector.dispatchEvent(new Event('change'));
                    dropDown.remove();
                });

                dropDown.appendChild(dropDownOption);
            });

            selector.appendChild(dropDown);

            // handle click out
            document.addEventListener('click', (e) => {
                if (!selector.contains(e.target)) {
                    dropDown.remove();
                }
            });
        }
    });
}