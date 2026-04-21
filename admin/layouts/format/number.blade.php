<script>

    const formatter_comma2 = new Intl.NumberFormat(['ban', 'de'], {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2,
    });

    const formatter_no_comma = new Intl.NumberFormat(['ban', 'de'], {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2,
    });

    let getNumberF = function getNumberF(value = 0){
        if((value/1000) < 100000){
            return `${formatter_comma2.format(value/1000)} K`;
        }else if((value/1000000) < 100000){
            return `${formatter_comma2.format(value/1000000)} M`;
        }else if((value/1000000000) < 1000000){
            return `${formatter_comma2.format(value/1000000000)} B`;
        }
        return `${formatter_comma2.format(value/1000000000000)} T`;
    }

    let getNumberI = function getNumberI(value = 0){
        if((value/1000) < 100000){
            return `${formatter_no_comma.format(value/1000)}k`;
        }else if((value/1000000) < 100000){
            return `${formatter_no_comma.format(value/1000000)}m`;
        }else if((value/1000000000) < 100000){
            return `${formatter_no_comma.format(value/1000000000)}b`;
        }
        return `${formatter_no_comma.format(value/1000000000000)}t`;
    }

    function onlyNumberKey(evt, input = null) {

        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
        let _c44 = true;
        if(input !== null){
            let _tvar = input.attr('data-tvar');
            // console.log(_tvar);
            if (typeof _tvar !== 'undefined' && _tvar !== false) {
                if(_tvar === 'int'){
                    _c44 = false;
                }
            }

            let _nonol = input.attr('data-nonol');
            // console.log(_nonol);
            if (typeof _nonol !== 'undefined' && _nonol !== false) {
                if(_nonol === 'true'){
                    // _c44 = false;
                }
            }
        }


        // console.log('44', _c44);
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)){
            if((ASCIICode == 44)){
                if(!_c44){
                    return false;
                }
            }else{
                return false;
            }
        }
        if(input.val() == '0' && ASCIICode != 44){
            if(ASCIICode >= 49 || ASCIICode <= 57){
                input.val('');
                return true;
            }
            return false;
        }
        return true;
    }

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        let _replace = n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return _replace;
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") { return; }

        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(",") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(",");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
            // right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = "" + left_side + "," + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "" + input_val;

            // final formatting
            if (blur === "blur") {
            // input_val += ".00";
            }
        }

        // send updated string to input
        // console.log(input, input.prop("maxLength"));
        input_val = input_val.substring(0, input.prop("maxLength"));
        input.val(input_val);

        // put caret back in the right position
        // var updated_len = input_val.length;
        // caret_pos = updated_len - original_len + caret_pos;
        // input[0].setSelectionRange(caret_pos, caret_pos);
        // console.log(input[0].setSelectionRange(caret_pos, caret_pos));
    }
</script>
