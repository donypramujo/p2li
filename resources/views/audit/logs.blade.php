
<ol>
	@forelse ($logs as $log)
	<li>{{ $log->customMessage }}
		<ul>
			@forelse ($log->customFields as $custom)
			<li>{{ $custom }}</li> @empty
			<li>No details</li> @endforelse
		</ul>
	</li> @empty
	<p>No logs</p>
	@endforelse
</ol>