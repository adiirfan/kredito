    function load_filter(pMenu_id)
    {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "admin/filter/get",
            dataType: 'json',
            data: {
                menu_id: pMenu_id},
            success: function(res) {
               if (res)
                {
                    var arr = [res.value1, res.value2, res.value3, res.value4, res.value5, res.value6, res.value7, res.value8, res.value9, res.value10];
                    get_filter(arr);
                }
            }
        });
    }

    function save_filter(pMenu_id, pValue1, pValue2, pValue3)
    {
        value1 = typeof pValue1 !== 'undefined' ? pValue1 : '';
        value2 = typeof pValue2 !== 'undefined' ? pValue2 : '';
        value3 = typeof pValue3 !== 'undefined' ? pValue3 : '';
        value4 = typeof pValue4 !== 'undefined' ? pValue4 : '';
        value5 = typeof pValue5 !== 'undefined' ? pValue5 : '';
        value6 = typeof pValue6 !== 'undefined' ? pValue6 : '';
        value7 = typeof pValue7 !== 'undefined' ? pValue7 : '';
        value8 = typeof pValue8 !== 'undefined' ? pValue8 : '';
        value9 = typeof pValue9 !== 'undefined' ? pValue9 : '';
        value10 = typeof pValue10 !== 'undefined' ? pValue10 : '';

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "admin/filter/add",
            dataType: 'json',
            data: {
                menu_id: pMenu_id,
                value1: value1,
                value2: value2,
                value3: value3,
                value4: value4,
                value5: value5,
                value6: value6,
                value7: value7,
                value8: value8,
                value9: value9,
                value10: value10},
            success: function(res) {
               //
            }
        });
    }