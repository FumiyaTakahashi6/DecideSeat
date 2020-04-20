// TODO: 前の行をコピーして行を生成する
function table_add(num) {
  // 行を削除
  table_delete();
  if (num != ''){
    for (i = 1; i < Number(num) + 2; i++) {
      var table = document.getElementById("table");
      // 行を行末に追加
      var row = table.insertRow(-1);
      //td分追加
      var cell1 = row.insertCell(-1);
      var cell2 = row.insertCell(-1);
      // セルの内容入力
      cell1.innerHTML = i;
      cell2.innerHTML = '<label for="table' + i + '">1</label><select name="data[table][' + i + ']" id="table' + i + '"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>';
    }
  }
}

function table_delete() {
  var table = document.getElementById("table");
  var rowLen = table.rows.length;
  //上の行から削除していくと下の行がずれていくので下から検査
  for (i = rowLen-1; i > 0; i--) {
      table.deleteRow(i);
  }
}