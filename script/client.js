$(document).ready(function () {
    $(document).on('click', '.discount-btn', function (event) {
        $('.dropdown').toggle();
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

    $(document).click(function () {
        $('.dropdown').hide();
    });

    $('.dropdown').click(function (event) {
        event.stopPropagation();
    });

    $(document).on('click', '.deleteRow', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('click', '.deleteRow', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('click', '.productBtn', function () {
        let rowHtml = `<tr>
          <td class="text-right pLeft quant">
          <select class="quantityOther quantity-select">
              <option value="1">1</option>
              <option value="2">2</option>
          </select>
      </td>
      <td class="text-center">
      <select class="other-select-des productInp service-select">
                                                        <option default>Select product/item</option>
                                                        <option value="Services">Services 1</option>
                                                        <option value="Services" default>Services 2</option>
                                                    </select>
      </td>
      <td class="text-center">
      <select class="other-select-des duration-select">
      <option value="2">2h</option>
      <option value="3">3h</option>
      <!-- Add more hour options if needed -->
  </select>
  <select class="other-select-des duration-minute-select">
      <option value="30">30m</option>
      <option value="45">45m</option>
  </select>
      </td>
      <td colspan="2" class="text-center position-relative totalPrice">
      <span class="discount-btn otherBTN">Discount</span>
          <input class="other-select-des-input price-input custom-placeholder" type="text" placeholder="Price Inc VAT">
      </td>
      <td class="text-end pLeft">
          <span class="deleteRow">
              <img src="./trash.svg" alt="">
          </span>
      </td>
      </tr>`;
        $('.table-body').append(rowHtml);
    });

    $(document).on('click', '.serviceBtn', function () {
        let rowHtml = `<tr>
        <td class="text-right pLeft quant">
            <select class="quantityOther quantity-select">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </td>
        <td class="text-center">
        <select class="other-select-des supsurvice service-select">
        <option default>Select Subservices</option>
        <option value="Services">Services 1</option>
        <option value="Services" default>Services 2</option>
    </select>
        </td>
        <td class="text-center">
          <select class="other-select-des duration-select">
            <option value="2">2h</option>
            <option value="3">3h</option>
            <!-- Add more hour options if needed -->
          </select>
          <select class="other-select-des duration-minute-select">
            <option value="30">30m</option>
            <option value="45">45m</option>
          </select>
        </td>
        <td colspan="2" class="text-center position-relative totalPrice">
            <span class="discount-btn otherBTN">Discount</span>
            <input class="other-select-des-input price-input custom-placeholder" type="text" placeholder="Price Inc VAT">
        </td>
        <td class="text-end pLeft">
            <span class="deleteRow">
                <img src="./trash.svg" alt="">
            </span>
        </td>
      </tr>`;
        $('.table-body').append(rowHtml);
    });

    $(document).on('click', '.otherBtn', function () {
        let rowHtml = `<tr>
        <td class="text-right pLeft quant">
            <select class="quantityOther quantity-select">
                <option value="1" default>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </td>
        <td class="text-center">
            <input class="other-select-des-input otherInput text-center  custom-placeholder" type="text" placeholder="Input">
        </td>
        <td class="text-center">
          <select class="other-select-des duration-select">
            <option value="2">2h</option>
            <option value="3">3h</option>
            <!-- Add more hour options if needed -->
          </select>
          <select class="other-select-des duration-minute-select">
            <option value="30">30m</option>
            <option value="45">45m</option>
          </select>
        </td>
        <td colspan="2" class="text-center position-relative totalPrice">
            <span class="discount-btn otherBTN">Discount</span>
            <input class="other-select-des-input price-input" type="text" placeholder="Price Inc VAT">
        </td>
        <td class="text-end pLeft">
            <span class="deleteRow">
                <img src="./trash.svg" alt="">
            </span>
        </td>
      </tr>`;
        $('.table-body').append(rowHtml);
    });

    $('#save').click(function () {
        let totalPrice = 0;
        let discountedPrice = 0;

        $('.price-input').each(function () {
            let price = parseFloat($(this).val());
            let quantity = parseFloat($(this).closest('tr').find('.quantity-select').val());
            totalPrice += price * quantity;
        });

        $('.table-body tr').each(function () {
            let price = parseFloat($(this).find('.price-input').val());
            let quantity = parseFloat($(this).find('.quantity-select').val());
            discountedPrice += price * quantity;
        });

        $('.totalPrice').text(totalPrice.toFixed(2));
        $('.discountedPrice').text(discountedPrice.toFixed(2))


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

        // Print the JSON object in the console
        console.log(data);

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
        if ( discountType === 'percentage' && (discountValue < 0 || discountValue > 100) ) {
            alert('Please enter a valid discount percentage.');
            return;
        }
        if ( discountType === 'fixed' && discountValue < 0 ) {
            alert('Please enter a valid discount value.');
            return;
        }
        // check if discount value is number or not
        if (isNaN(discountValue)) {
            alert('Please enter a valid discount value.');
            return;
        }

        let priceInput = dropdown.data("priceInput");
        let price = parseFloat(priceInput.val());
        let discountedPrice = 0;

        if (discountType === 'fixed') {
            discountedPrice = price - parseFloat(discountValue);
        } else if (discountType === 'percentage') {
            let discountPercentage = parseFloat(discountValue);
            discountedPrice = price - (price * (discountPercentage / 100));
        }

        priceInput.val(discountedPrice.toFixed(2) || '');

        // clear the dropdown
        dropdown.find('.input-des').val('');
        dropdown.hide(); // Hide the dropdown after saving
    });





});
