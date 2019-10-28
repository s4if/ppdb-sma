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

function assignVal(formAction, namaVal, UHVal, kelasVal){
    $("#addModalForm").attr("action", formAction);
    $("#addModalInputNama").attr("value", namaVal);
    $("#addModalInputUH").attr("value", UHVal);
    $("#addModelInputKelas").attr("value", kelasVal);
};

function leading_zero(angka) {
    if (angka == 0) {
        return '000';
    } else if (angka < 10) {
        return '00'+String(angka);
    } else if (angka < 100) {
        return '0'+String(angka);
    } else {
        return String(angka);
    }
}

function format_rupiah(angka) {
	var miliaran = Math.floor(angka/1000000000)
	var sisa_miliaran = angka % 1000000000;
    var jutaan = Math.floor(sisa_miliaran/1000000);
    var sisa_jutaan = angka % 1000000;
    var ribuan = Math.floor(sisa_jutaan/1000);
    var sisa_ribuan = sisa_jutaan % 1000;
    var str_angka = "";
    if (angka > 999999999) {
        str_angka = 'Rp. '+ String(miliaran)+'.'+leading_zero(jutaan)+'.'+leading_zero(ribuan)+'.'+leading_zero(sisa_ribuan)+',-';
    } else if (angka > 999999) {
        str_angka = 'Rp. '+ String(jutaan)+'.'+leading_zero(ribuan)+'.'+leading_zero(sisa_ribuan)+',-';
    } else if(angka > 999){
        str_angka = 'Rp. '+ String(ribuan)+'.'+leading_zero(sisa_ribuan)+',-';
    } else {
        str_angka = 'Rp. '+ String(sisa_ribuan)+',-';
    }
    return str_angka;
}