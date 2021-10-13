@extends('layouts.app')

@section('title', 'TASK')

@section('content')

@include('pages.components.header')

@include('pages.components.asidenav')

@include('pages.components.sidebarchat')

<div class="content-wrapper">
   <!-- Container-fluid starts -->

   <!-- Container-fluid starts -->
   <div class="container-fluid">
      <!-- Row Starts -->
      <div class="row">
         <div class="col-sm-12 p-0">
            <div class="main-header">
               <h4>Some of Operations</h4>
               <ol class="breadcrumb breadcrumb-arrow">
                  
                  <li class="breadcrumb-item"><a>REGISTER URLs</a>
                  </li>
                  <li class="breadcrumb-item"><a>STK PUSH </a>
                  </li>
                  <li class="breadcrumb-item"><a>B2C </a>
                  </li>
               </ol>
            </div>
         </div>
      </div>
      <!-- Row end -->
      <div class="row">

      @include('pages.components.ifmessage')
                     <!-- content goes here  -->
         <div class="col-md-12">


            <div class="card">
               <div class="card-block">
                  <div class="md-card-block">
                  
                                 <div class="card-header">
                                    <h5 class="card-header-text">REGISTER URLs</h5>
                                    <p  class="text-blue">1. Validation URL.</p>

                                    <p  class="text-blue">2. Confirmation URL.</p>

                                    <div class="f-right">
                                       <a href="{{ route('registerurls') }}" class="btn btn-success waves-effect waves-light m-r-30">Submit</a>
                                    </div>
                                 </div>

                  </div>
               </div>
            </div>


            <!--  -->

            <div class="card">
               <div class="card-block">
                  <div class="md-card-block">                   
                     <div class="card">
                        <div class="card-block">
                           <form action="{{ route('pushstk') }}" method="POST">
                              @csrf

                              <h5 class="card-header-text">STK PUSH TEST</h5>

                              <div class="form-group row">
                                 <label for="exampleSelect1" class="col-form-label form-control-label">Enter Mobile Number e.g 07XXXXXXXX: </label>
                                 <input class="form-control" type="number" name="fromphone" placeholder="0712345678" required />
                              </div>

                              <div class="form-group row">
                                 <label for="example-number-input" class="col-form-label form-control-label">Amount</label>
                                 <input class="form-control" type="number" name="amounttodeposit" id="example-number-input" required />
                              </div>

                              <button type="submit" class="btn btn-success waves-effect waves-light m-r-30">SUBMIT</button>
                           </form>
                        </div>                        
                     </div>
                  </div>
               </div>
            </div>

            <!--  -->

            <div class="card">
            
               <div class="card-block">
               <h5 class="card-header-text">Business To Customer Transaction</h5>
                  <div class="md-card-block">                   
                     <div class="card">
                        <div class="card-block">
                        
                           <form action="{{ route('b2c') }}" method="POST">
                              @csrf

                              

                              <div class="form-group row">
                                 <label for="exampleSelect1" class="col-form-label form-control-label">Receiver Mobile Number e.g 07XXXXXXXX: </label>
                                 <input class="form-control" type="number" name="tophone" placeholder="0712345678" required />
                              </div>

                              <div class="form-group row">
                                 <label for="example-number-input" class="col-form-label form-control-label">Amount</label>
                                 <input class="form-control" type="text" name="amounttowithraw" id="example-number-input" required />
                              </div>

                              <div class="form-group row">
                                 <label for="example-number-input" class="col-form-label form-control-label">Remarks</label>
                                 <input class="form-control" type="text" name="remarks" id="example-text-input" required />
                              </div>

                              <div class="form-group row">
                                 <label for="example-number-input" class="col-form-label form-control-label">Occasion</label>
                                 <input class="form-control" type="text" name="occasion" id="example-text-input" required />
                              </div>

                              <button type="submit" class="btn btn-success waves-effect waves-light m-r-30">SUBMIT</button>
                           </form>
                        </div>                        
                     </div>
                  </div>
               </div>
            </div>


         </div>
      </div>
   </div>
   <!-- Container-fluid ends -->
   <!-- Container-fluid ends -->
   @include('pages.components.actionbutton')

</div>
</div>

@endsection