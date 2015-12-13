<?php

/* 
 * The MIT License
 *
 * Copyright 2014 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>

<?php if($cdn):?>

<!-- Bootstrap DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/r/bs/jszip-2.5.0,dt-1.10.9,b-1.0.3,b-colvis-1.0.3,b-print-1.0.3,cr-1.2.0,fc-3.1.0,fh-3.0.0,kt-2.0.0,r-1.0.7,rr-1.0.0,sc-1.3.0,se-1.0.1/datatables.min.js"></script>

<!-- Bootstrap DatePickers JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>

<?php else :?>

<!-- Bootstrap DataTables JS -->
<script src="<?=  base_url() ?>assets/js/datatables.min.js"></script>

<!-- Bootstrap DatePickers JavaScript -->
<script src="<?=  base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>

<?php endif;?>

<!-- User Js -->
<script src="<?=  base_url() ?>assets/js/user.js"></script>

<script type="text/javascript">
    $('.datepicker').datepicker({
        startView : 'decade',
        language : 'id-ID'
    });
</script>

</body>

</html>