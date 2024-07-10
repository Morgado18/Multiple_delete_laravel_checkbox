
{{-- HTML --}}

<a href="" id="delete_all_selected"><button>Purge</button></a>

<table>
  
    <thead>
      <th>
        <input type="checkbox" name="ids" id="select_all_ids" class="checbox_ids">
      </th>
    </thead>
  
    <tbody>
      <tbody>
        <tr id="dado">
          <td>
            <input type="checkbox" name="ids" id="ids" value="id_dado_db" class="checkbox_ids">
          </td>
        </tr>
      </tbody>
    </tbody>
  
</table>

{{-- JS --}}

$(function(e)){
  $('#select_all_ids').click(function(){
    $('.checkbox_ids').prop('checked',$(this).prop('checked')); // select all fields and take the value
  })

  $('#delete_all_selected').click(function(e){

    e.preventDefault()
    var all_ids = []
    $('input:checkbox[name=ids]:checked').each(function(){
      all_ids.push($(this).val()) // take value the inputs cchecked 
    })

    $.ajax({
      url: '{{route('')}}',
      type: 'GET',
      data: {
        ids:all_ids
      },
      success:function(response){
        console.log(all_ids)
        $.each(all_ids, function(key, val){
          $('#dado'+val).remove() // irá remover da lista no reload the page
        })
        Swal.fire({
            title: Dado(s)",
            text: "Purgado(s) com sucesso",
            icon: "success"
        });
      }
      error:function(){
         if($('input:checked[name=ids]').lenght === 0){
             Swal.fire({
                title: Erro",
                text: "Nenhum inten selecionado,
                icon: "warning"
            });
         } else{
           Swal.fire({
              title: Dado(s)",
              text: "Purgado(s) com sucesso",
              icon: "error"
          });
        }
      }
    })

  })
}

{{-- CONTROLLER --}}

public function purge(Request $request){
  Model::whereIn('id',$request->ids)->delete();
  return response()->json(['sucesso'=>'ok']);
}
