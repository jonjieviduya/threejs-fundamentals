<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="#">
	<title>ThreeJS Fundamentals</title>
</head>
<body>
	<canvas id="c"></canvas>

	<script type="module">
		import * as THREE from './threejs/build/three.module.js'
		
		function main() {
			const canvas = document.querySelector('#c')
			const renderer = new THREE.WebGLRenderer({ canvas })

			const fov = 75
			const aspect = 2
			const near = 0.1
			const far = 5
			const camera = new THREE.PerspectiveCamera(fov, aspect, near, far)

			camera.position.z = 2

			const scene = new THREE.Scene()

			{
				const lightingColor = 0xFFFFFF
				const intensity = 1
				const light = new THREE.DirectionalLight(lightingColor, intensity)
				light.position.set(-1, 2, 4)
				scene.add(light)
			}

			const boxWidth = 1
			const boxHeight = 1
			const boxDepth = 1

			const geometry = new THREE.BoxGeometry(boxWidth, boxHeight, boxDepth)

			function makeInstance(geometry, color, x) {
				const material = new THREE.MeshPhongMaterial({ color: color })
				const cube = new THREE.Mesh(geometry, material)

				scene.add(cube)

				cube.position.x = x

				return cube
			}

			const cubes = [
				makeInstance(geometry, 0x44aa88, 0),
				makeInstance(geometry, 0x8844aa, -2),
				makeInstance(geometry, 0xaa8844, 2)
			]

			function render(time) {
				time *= 0.001

				cubes.forEach((cube, index) => {
					const speed = 1 + index * .1
					const rotation = time * speed

					cube.rotation.x = rotation
					cube.rotation.y = rotation
				})

				renderer.render(scene, camera)

				requestAnimationFrame(render)
			}

			requestAnimationFrame(render)

		}

		main()
	</script>
</body>
</html>
