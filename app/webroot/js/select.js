// TODO: 前の行をコピーして行を生成する
function table_add(num) {
	// 行を削除
	table_delete();
	if (num != "") {
		for (i = 0; i < Number(num); i++) {
			const table = document.getElementById("seat_table");
			// 行を行末に追加
			const row = table.insertRow(-1);
			//td分追加
			const cell1 = row.insertCell(-1);
			const cell2 = row.insertCell(-1);
			// セルの内容入力
			cell1.innerHTML = i + 1;
			cell2.innerHTML =
				`<select name="data[Table][seat_sum][` +
				i +
				`]" class="form-control form-control-sm col-sm-6" id="TableSeatSum` +
				i +
				`">
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
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
            </select>`;
		}
	}
}

function table_delete() {
	const table = document.getElementById("seat_table");
	const rowLen = table.rows.length;
	//上の行から削除していくと下の行がずれていくので下から検査
	for (i = rowLen - 1; i > 0; i--) {
		table.deleteRow(i);
	}
}

$(window).load(function () {
	$("input:checkbox")
		.change(function () {
			const participant_count = $("#participant_table input:checkbox:checked")
				.length;
			$(".tohokuret").text("参加人数： " + participant_count + "　人");
			settings_check();
		})
		.trigger("change");

	$("#table_setting")
		.change(function () {
			let seat_count = 0;
			$("#seat_table select").each(function () {
				seat_count = seat_count + Number($(this).val());
			});
			$(".tohokuret2").text("座席数： " + seat_count + "　人");
			settings_check();
		})
		.trigger("change");
});

function settings_check() {
	const participant_count = $("#participant_table input:checkbox:checked")
		.length;
	let seat_count = 0;
	$("#seat_table select").each(function () {
		seat_count = seat_count + Number($(this).val());
	});
	if (participant_count == 0 && seat_count == 0) {
		$(".tohokuret3").text("※参加者と座席が設定されていません");
	} else if (participant_count == 0) {
		$(".tohokuret3").text("※参加者が設定されていません");
	} else if (seat_count == 0) {
		$(".tohokuret3").text("※座席が設定されていません");
	} else if (participant_count > seat_count) {
		$(".tohokuret3").text("※座席数が足りていません");
	} else {
		$(".tohokuret3").text("");
	}
}
