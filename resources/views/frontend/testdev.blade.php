@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - testdev</title>
@endsection

@section('content')
@include('frontend.layouts.inc_profile')	

<div class="button btn btn-success" id="loop" data-loop="">Loop</div>
<div class="button btn btn-success" id="start" data-process="">START</div>
<section class="row"><div class="col-12 page-profile"></div></section>
@endsection

@section('script')
<script>
    // Loop button functionality
    document.getElementById('loop').addEventListener('click', function() {
        let loopButton = document.getElementById('loop');
        let currentLoopStatus = loopButton.getAttribute('data-loop');

        if (currentLoopStatus === '') {
            loopButton.setAttribute('data-loop', 'loop');
            loopButton.textContent = 'Stop';
        } else {
            loopButton.setAttribute('data-loop', '');
            loopButton.textContent = 'Loop';
        }
    });

    // Start button functionality
    document.getElementById('start').addEventListener('click', function() {
        console.log("start");
        let startButton = document.getElementById('start');

        if (startButton.getAttribute('data-process') === '') {
            // Update the data-process attribute to indicate the process is running
            startButton.setAttribute('data-process', 'processing');
            
            // Change button text to 'Processing...'
            startButton.textContent = 'Processing...';
            console.log("process");
            // Trigger the AJAX request
            fetch('{{ route("convertcar") }}')
                .then(response => response.json())
                .then(data => {
                    // Display only the IDs of the converted cars
                    data.convertedCarIds.forEach((id) => {
                        console.log(`Car ID: ${id}`);
                    });

                    // Reset the process attribute and button text after successful completion
                    startButton.setAttribute('data-process', '');
                    startButton.textContent = 'Start';
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Reset the process attribute and button text even on error
                    startButton.setAttribute('data-process', '');
                    startButton.textContent = 'False';
                });
        }
    });

    // Automatically trigger the start button every 10 seconds if loop is active
    setInterval(function() {
        let startButton = document.getElementById('start');
        let loopButton = document.getElementById('loop');

        if (loopButton.getAttribute('data-loop') === 'loop' && startButton.getAttribute('data-process') === '') {
            startButton.click();
        }
    }, 4000); // 4 seconds
</script>
@endsection
