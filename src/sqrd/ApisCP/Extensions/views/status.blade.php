<div class="col-12 mt-3 text-center status-indicator">
    @php
        $monitor = new \sqrd\ApisCP\Extensions\BetterUptime();
        $status = $monitor->getNetworkStatus();
    @endphp
    <a data-toggle="tooltip" title="{{ $title }}"
       href="{{ $monitor->getStatusPage() }}">
		<span class="fa fa-circle mr-1 {{ $monitor->textByStatus() }}"></span>
        <span>Network Status</span>
        <span>{{ $monitor->getStatusPageID() }}</span>
    </a>
</div>
