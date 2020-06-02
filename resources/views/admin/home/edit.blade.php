<input type="hidden" name="id" id="id" value="{{$data->banner_id}}">
<input type="hidden" name="image" id="image" value="{{$data->banner_image}}">
<div class="form-group">
    <input type="text" class="form-control" name="name" id="name" value="{{$data->banner_name}}" placeholder="Banner Name">
</div>
<div class="form-group">
    <textarea name="description" id="description" cols="3" rows="3" class="form-control" placeholder="Description">{{$data->banner_description}}</textarea>
</div>
<div class="form-group">
    <input type="file" name="file" id="file" class="form-control">
</div>

<script>

</script>
