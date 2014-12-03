@foreach($checkdomains as $checkdomain)
<div class="list-group-item">
      <div class="domain-option">{{ $checkdomain->domain }}</div>
      <div class="domain-option-cost">{{ $checkdomain->cost }}</div>
      <div class="domain-option-select" onclick="select_domain_option('{{$checkdomain->domain}}')">
            <h4><span class="label label-primary">{{ trans("frontend.button.checkdomain.select") }}</span></h4>
      </div>
</div>
@endforeach