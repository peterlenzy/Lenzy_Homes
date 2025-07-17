!
<style>
    #viewer-container {
        width: 100%;
        height: 600px;
        border: 1px solid #ccc;
        margin-top: 20px;
        position: relative;
    }

    canvas {
        display: block;
        width: 100% !important;
        height: 100% !important;
    }

    #loading-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 5px;
        font-weight: bold;
        color: #333;
    }
</style>

<div class="container mt-5">
    <h2>{{ $house->name }} - 3D Model Viewer</h2>
    <p><strong>Location:</strong> {{ $house->location }} | <strong>Bedrooms:</strong> {{ $house->bedrooms }}</p>

    <div id="viewer-container">
        <div id="loading-message">Loading 3D Model...</div>
        <canvas id="three-canvas"></canvas>
    </div>

   <a href="{{ route('houses.index') }}" class="btn btn-outline-primary mt-3">
    <i class="bi bi-arrow-left-circle me-2"></i> Back to Houses
</a>
</div>

<!-- ✅ Three.js + GLTFLoader CDN -->

<script>
    window.modelUrl = @json(Storage::url($house->model_path));
</script>
<script type="module" src="{{ asset('js/viewer.js') }}"></script>


