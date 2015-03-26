@extends('app')

@section('content')


  <div class="main-nav">
    <div class="row">
      <div class="large-12">
        <div id="Logo"><a href="/"><img src="{{ asset('/img/shirtwascash_logo.png') }}"></a></div>
        <nav class="navigation">
          <ul>
            @if(Auth::check())
              <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
            @else
              <li><a href="{{ url('/auth/register') }}">Register</a></li>
            @endif
            <li><a href="#drop-files" class="create" id="CreateShirt">Create Shirt</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>



  


<div id="drop-files" class="tshirt-container">
  <div id="TshirtPreview" class="preview">
    <a href="#" id="changeimage" data-html2canvas-ignore="true" alt="Change image" title="Change image"><i class="icon-arrows-cw"></i></a>
    <div class="tshirt-mask"><img src="img/tshirt_mask.png"></div>
    <div id="tshirt-base" class="tshirt-base"></div>
    <div class="tshirt-design"><div id="tshirtdesigncontainer"></div><img src="" id="tshirtdesign"></div>
    <div class="tshirt-image"><img src="img/tshirt_image.png"></div>
  </div>
  <div id="UploadOptions" class="upload">
    <div id="browsecomputer" class="upload-option browse-computer">
      <p>BROWSE YOUR <br>COMPUTER</p>
      <label>
        <input type="file" id="ComputerImageHolder">
      </label>
    </div>
    <div class="upload-option">
      <p>copy paste image <br>url</p>
    </div>
    <div class="upload-option bottom-option">
      <p>drag and drop <br>image</p>
    </div>
    <div class="upload-option bottom-option">
      <p>paste from your <br>clipboard</p>
    </div>
  </div>
  <div class="options">
    <div class="option-row">
      <label>shirt color</label>
      <input id="inputhex" type="text" class="input color-hex" placeholder="00000" value="000000" maxlength="6"> 
      <a id="eyedropper" class="color chooser">
        <i class="icon-eyedropper"></i>
      </a>    
      <a id="ColorPicker" class="color chooser">
        <i class="icon-brush"></i>
      </a>                  
      <a class="color color-white" href="#" data-hex="fff"></a>
      <a class="color color-black" href="#" data-hex="000"></a>

    </div>
    <div class="slider">
      <label>rotate image</label>
      <div id="rotate-image"></div>
    </div>
    <div class="slider">
      <label>size and scale</label>
      <div id="sizeandscale"></div>
    </div>  

    <div class="option-row">
      <label>title</label>
      <input type="text" class="input">
    </div>     

    <div class="option-row">
      <label>description</label>
      <textarea class="input"></textarea>
    </div>             

    <div class="option-row">
      <input type="submit" value="Submit Shirtpost" class="submit">
      <a href="#" id="SaveMockup" class="save-mockup">Save Mockup</a>
    </div>
  </div>
</div>


<div class="tshirt-list row">
  <div class="row">
    <div class="large-12 columns">
      <h1>Have an idea for a Tshirt? You’ve come to the right place</h1>
    </div>
  </div>

  <div class="row">
    @foreach($shirts as $shirt)
      <div class="large-3 columns">
        <div class="shirt">
          <a href="#">
            <img src="{{route('shirt.show', $shirt->name)}}">
          </a>
          <p>{{$shirt->name}}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>


@endsection
