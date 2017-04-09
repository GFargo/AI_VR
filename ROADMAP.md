# Roadmap

The end goal with this would be to have somethign like React initialize and work with the A-Frame scene.  This could be done by localizing the JSON data to the `window` object and then passing it to the a React component.

- [A-Frame React Lib](https://github.com/aframevr/aframe-react)
- [Awesome A-Frame - Big ol List of Stuff](https://github.com/aframevr/awesome-aframe)
- [Youtube: Intro to React VR](https://www.youtube.com/watch?v=CtVo3z_o9Rw)
- https://www.reddit.com/r/WebVR/
- [Building a Snowglobe in VR](https://medium.com/@jaredpike/how-we-built-a-vr-snow-globe-9bf151f847e)


Look into [A-Frame performance](https://aframe.io/docs/0.5.0/introduction/best-practices.html#performance).

### Image Sizes

Should we register two new thumbnail sizes in WP-Core sized to powers of two (e.g., 256x256, 512x1024) in order to avoid the renderer having to resize the texture during runtime.  It'd be great to use a plugin like photon to easily serve up cropped images, but we may run into x-origin issues.


### Angle CLI Tool

https://www.npmjs.com/package/angle

### Text to Speech

https://aws.amazon.com/polly/

https://www.npmjs.com/package/node-tts - Run a TTS Server via Node.js on OSX
