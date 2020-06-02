<tr>
    <td colspan="5" >
        <div class="row">
            <div class="col-md-3 col-md-offset-4" style="text-align: right;">
                <b>{{$title}}</b>
            </div>
            <div class="col-md-5">
                <label class="radio-inline"><input type="radio" name="{{$name}}" value="0" checked>No Aplica</label>
                @foreach($taxes as $taxe)
                <label class="radio-inline"><input type="radio" name="{{$name}}" value="{{$taxe}}">{{ number_format($taxe,1,'.',',')  }} %</label>
                @endforeach
            </div>
        </div>
    </td>
    <td id="{{ str_replace('_','',$name) }}" style="text-align: right;">
        0,00
    </td>
</tr>