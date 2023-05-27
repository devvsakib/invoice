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
            <option default>Services</option>
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
      <td class="text-center">
      <input class="other-select-des-input text-center vat-input custom-placeholder" type="text"
          placeholder="% VAT">
  </td>
      <td colspan="2" class="text-center position-relative">
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
        <option default>Services</option>
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
        <td class="text-center">
        <input class="other-select-des-input text-center vat-input custom-placeholder" type="text"
            placeholder="% VAT">
    </td>
        <td colspan="2" class="text-center position-relative">
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
        <td class="text-center">
        <input class="other-select-des-input text-center vat-input custom-placeholder" type="text"
            placeholder="% VAT">
    </td>
        <td colspan="2" class="text-center position-relative">
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
            let vat = $row.find('.vat-input').val();
            let price = $row.find('.price-input').val();

            // Validate required fields
            if (quantity === '' || description === '' || durationHours === '' || durationMinutes === '' || price === '' || vat === '') {
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
                vat: vat + ' %',
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
                    let inputValue = $input.val();
                    if ($input.hasClass('price-input')) {
                      inputValue += ' EUR';
                    } else {
                        inputValue += '%';
                    }
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
        
        console.log(data);
    });
});
