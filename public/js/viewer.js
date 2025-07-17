import * as THREE from 'https://unpkg.com/three@0.158.0/build/three.module.js';
import { GLTFLoader } from './Three/GLTFLoader.js';
import { OrbitControls } from './Three/OrbitControls.js';

// Get the canvas
const canvas = document.getElementById('three-canvas');
const renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
const scene = new THREE.Scene();
scene.background = new THREE.Color(0xf0f0f0);

// Camera
const camera = new THREE.PerspectiveCamera(75, canvas.clientWidth / canvas.clientHeight, 0.01, 5000);
camera.position.set(0, 1.5, 5);

// Orbit Controls
const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;

// Resize renderer
renderer.setSize(canvas.clientWidth, canvas.clientHeight);
renderer.setPixelRatio(window.devicePixelRatio);

// Lighting
const ambientLight = new THREE.AmbientLight(0xffffff, 1.5);
const directionalLight = new THREE.DirectionalLight(0xffffff, 1.2);
directionalLight.position.set(10, 10, 10);
const hemiLight = new THREE.HemisphereLight(0xffffff, 0x444444, 1.2);
scene.add(ambientLight, directionalLight, hemiLight);

// Load model
const loader = new GLTFLoader();
const modelUrl = window.modelUrl; // Defined in blade file with script

console.log('Loading model from:', modelUrl);

loader.load(
    modelUrl,
    function (gltf) {
        const model = gltf.scene;

        // Optional: scale model if too small or large
        model.scale.set(1, 1, 1);

        // Center the model
        const box = new THREE.Box3().setFromObject(model);
        const center = box.getCenter(new THREE.Vector3());
        model.position.sub(center);

        // Ensure visibility and render both sides
        model.traverse((node) => {
            if (node.isMesh) {
                node.visible = true;
                node.material.side = THREE.DoubleSide;
            }
        });

        scene.add(model);
        document.getElementById('loading-message').style.display = 'none';
    },
    function (xhr) {
        console.log(`Loading: ${(xhr.loaded / xhr.total * 100).toFixed(2)}%`);
    },
    function (error) {
        console.error('Error loading model:', error);
        document.getElementById('loading-message').textContent = 'Failed to load model.';
    }
);

// Render loop
function animate() {
    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene, camera);
}
animate();

// Responsive canvas
window.addEventListener('resize', () => {
    const width = canvas.clientWidth;
    const height = canvas.clientHeight;
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
    renderer.setSize(width, height);
});
