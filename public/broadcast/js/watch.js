let peerConnection;
const config = {
  iceServers: [
      { 
        "urls": "stun:stun.l.google.com:19302",
      
        
         "username": "TURN_USERNAME",
         "credential": "TURN_CREDENTIALS"} 
      
  ]
};

const socket = io(window.location.protocol + "//" + window.location.hostname + ":4000", {
  withCredentials: true,
  extraHeaders: {
    "my-custom-header": "abcd"
  }
});

const video = window.matchMedia("(max-width: 1024px)").matches ? document.querySelector("#mobile-video") : document.querySelector("#video");
const enableAudioButton = window.matchMedia("(max-width: 1024px)").matches ? document.querySelector("#enable-audio-mobile") : document.querySelector("#enable-audio");
const muteAudioButton = window.matchMedia("(max-width: 1024px)").matches ? document.querySelector("#mute-audio-mobile") : document.querySelector("#mute-audio");

enableAudioButton.addEventListener("click", enableAudio)
muteAudioButton.addEventListener("click", muteAudio)

socket.on("offer", (id, description) => {
  peerConnection = new RTCPeerConnection(config);
  peerConnection
    .setRemoteDescription(description)
    .then(() => peerConnection.createAnswer())
    .then(sdp => peerConnection.setLocalDescription(sdp))
    .then(() => {
      socket.emit("answer", id, peerConnection.localDescription);
    });
  peerConnection.ontrack = event => {
    video.srcObject = event.streams[0];
  };
  peerConnection.onicecandidate = event => {
    if (event.candidate) {
      socket.emit("candidate", id, event.candidate);
    }
  };
});


socket.on("candidate", (id, candidate) => {
  peerConnection
    .addIceCandidate(new RTCIceCandidate(candidate))
    .catch(e => console.error(e));
});

socket.on("connect", () => {
  socket.emit("watcher");
});

socket.on("broadcaster", () => {
  socket.emit("watcher");
});

window.onunload = window.onbeforeunload = () => {
  socket.close();
  if(peerConnection != null){
    peerConnection.close();
  }
};

function enableAudio() {
  console.log("Enabling audio")
  video.muted = false;
}

function muteAudio() {
  console.log("muting audio");
  video.muted = true;
}