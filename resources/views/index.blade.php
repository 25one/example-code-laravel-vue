@extends('layout')

@section('css')

@endsection
 
<script>
   let user = <?php echo json_encode($user); ?>;
   //console.log(user);
</script> 

@section('main')

   <booking-component></booking-component>

@endsection

@section('js')

@endsection
