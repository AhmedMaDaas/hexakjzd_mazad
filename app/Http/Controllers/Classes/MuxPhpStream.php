<?php
namespace App\Http\Controllers\Classes;

class MuxPhpStream
{
	private static $stream;
	private $MUX_TOKEN_ID = 'b2271a7b-ad8f-4c2d-87a0-160e8d7e3f3c';
	private $MUX_TOKEN_SECRET = '7ZIfFFUwEI7HtlKjzlfyD3jW/p31gSgLQ6hSukq8o3ijsY0sLUsOxkVIJVt+ROLf7mS0anvV8zz';

	public function getStream(){
		return Self::$stream;
	}

	private function getConfig(){
		assert_options(ASSERT_BAIL, true);
		$config = \MuxPhp\Configuration::getDefaultConfiguration()
        ->setUsername($this->MUX_TOKEN_ID)
        ->setPassword($this->MUX_TOKEN_SECRET);

        return $config;
	}

	private function getLiveAPI(){
		$liveApi = new \MuxPhp\Api\LiveStreamsApi(
	        new \GuzzleHttp\Client(),
	        $this->getConfig()
	    );

	    return $liveApi;
	}

	public function createLiveStream(){
		$liveApi = $this->getLiveAPI();

		$createAssetRequest = new \MuxPhp\Models\CreateAssetRequest(["playback_policy" => [\MuxPhp\Models\PlaybackPolicy::PUBLIC_PLAYBACK_POLICY]]);

	    $createLiveStreamRequest = new \MuxPhp\Models\CreateLiveStreamRequest(["playback_policy" => [\MuxPhp\Models\PlaybackPolicy::PUBLIC_PLAYBACK_POLICY], "new_asset_settings" => $createAssetRequest, "reduced_latency" => true]);

	    Self::$stream = $liveApi->createLiveStream($createLiveStreamRequest);
	    assert(Self::$stream->getData()->getId() != null);
	}

	public function getLiveStream(){
		$liveApi = $this->getLiveAPI();

		$getStream = $liveApi->getLiveStream(Self::$stream->getData()->getId());
	    assert($getStream->getData()->getId() != null);
	    assert($getStream->getData()->getId() == Self::$stream->getData()->getId());
	    return "https://stream.mux.com/" . Self::$stream->getData()->getPlaybackIds()[0]->getId() . ".m3u8";
	}
}