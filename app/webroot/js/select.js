// TODO: 前の行をコピーして行を生成する
function table_add(num) {
  // 行を削除
  table_delete();
  if (num != ''){
    for (i = 0; i < Number(num); i++) {
      let table = document.getElementById("table");
      // 行を行末に追加
      let row = table.insertRow(-1);
      //alert(table.insertRow(-1));
      //td分追加
      let cell1 = row.insertCell(-1);
      let cell2 = row.insertCell(-1);
      // セルの内容入力
      cell1.innerHTML = i + 1;
      cell2.innerHTML = `<select name="data[Table][seat_sum][` + i + `]" class="form-control form-control-sm col-sm-6" id="TableSeatSum` + i + `">
            <option value="0" selected="selected">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            </select>`;
    }
  }
}

function table_delete() {
  let table = document.getElementById("table");
  let rowLen = table.rows.length;
  //上の行から削除していくと下の行がずれていくので下から検査
  for (i = rowLen-1; i > 0; i--) {
      table.deleteRow(i);
  }
}

$(window).load(function(){
  $('input:checkbox').change(function() {
      let cnt = $('#participant_table input:checkbox:checked').length;
      $('.tohokuret').text('参加人数： ' + cnt + '　人');
  }).trigger('change');
});