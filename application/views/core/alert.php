<?php

/* 
 * The MIT License
 *
 * Copyright 2015 s4if.
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
<div class="col-lg-12" id="alert-div">
<?php if(empty($this->session->flashdata('notices')) === false): ?>
<div class="alert alert-success alert-dismissible">
<?php
    echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
            '<span aria-hidden="true">&times;</span><span class="sr-only">'.
            'Close</span></button>'.
            implode('</p><p>', $this->session->flashdata('notices')) . '</p>';	
    ?>
</div>
<?php endif; ?>
<?php if(empty($this->session->flashdata('errors')) === false): ?>
<div class="alert alert-danger alert-dismissible">
<?php
    echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
            '<span aria-hidden="true">&times;</span><span class="sr-only">'.
            'Close</span></button>'.
            implode('</p><p>', $this->session->flashdata('errors')) . '</p></span></button>';	
    ?>
</div>
<?php endif; ?>
<?php if(empty($this->session->flashdata('warnings')) === false): ?>
<div class="alert alert-warning alert-dismissible">
<?php
    echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
            '<span aria-hidden="true">&times;</span><span class="sr-only">'.
            'Close</span></button>'.
            implode('</p><p>', $this->session->flashdata('warnings')) . '</p></span></button>';	
    ?>
</div>
<?php endif; ?>
</div>


<div class="modal fade" id="modal-alert-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifikasi</h4>
            </div>
            <div class="modal-body">
                
                        <h4 class="text-center">
                            <span class="glyphicon glyphicon-ok-sign"></span>
                            Data telah berhasil disimpan
                        </h4>
            </div>
            <div class="modal-footer" >
                <div class="center-block">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary insert-lanjut" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-alert-failed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifikasi</h4>
            </div>
            <div class="modal-body">
                
                        <h4 class="text-center">
                            <span class="glyphicon glyphicon-remove-sign"></span>
                            Maaf, data gagal disimpan, mohon cek kembali data yang anda masukkan!
                        </h4>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <div class="col-md-2 col-md-offset-5">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>