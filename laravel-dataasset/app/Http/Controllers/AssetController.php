<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Kategori;
use App\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::all();

        $assets = Asset::join('kategoris', 'assets.idkategori', '=' , 'kategoris.id')
                ->select('kategoris.*','assets.*')
                ->orderBy('assets.id', 'desc')
                ->paginate(10);

        return view('asset.list', [
            'title' => 'Asset',
            'assets' => $assets,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kategoris = Kategori::all();

        return view('asset.create', [
            'title' => 'Asset Baru',
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:9999',
            'asset'     => 'required',
            'idkategori'     => 'required|numeric',
            'merk'      => 'required',
            'tahunbeli'     => 'required|numeric',
            'harga'     => 'required|numeric',
            'umurekonomis'     => 'required|numeric',
            'nilairesidu'     => 'required|numeric',
            'spek'      => 'required',
            'latitude'      => 'required',
            'longtitude'      => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/assets', $image->hashName());

        Asset::create([
            'image'     => $image->hashName(),
            'asset'     => $request->asset,
            'idkategori'     => $request->idkategori,
            'merk'      => $request->merk,
            'tahunbeli'     => $request->tahunbeli,
            'harga'     => $request->harga,
            'umurekonomis'     => $request->umurekonomis,
            'nilairesidu'     => $request->nilairesidu,
            'spek'     => $request->spek,
            'latitude'     => $request->latitude,
            'longtitude'     => $request->longtitude,
        ]);

        return redirect()->route('asset.index')->with('message', 'Asset berhasil ditambahkan!');
    }

    /**
     * show
     *
     * @param  mixed $id
     */
    public function show($id)
    {
        //get post by ID
        $asset = Asset::join('kategoris', 'assets.idkategori', '=' , 'kategoris.id')
        ->select('kategoris.*','assets.*')
        ->findOrFail($id);

        //render view with post
        return view('asset.detail', [
            'title' => 'Detail Asset',
        ], compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {

        $kategoris = Kategori::all();

        return view('asset.edit', [
            'title' => 'Edit Asset',
            'asset' => $asset,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {

        //validate form
        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:9999',
            'asset'     => 'required',
            'idkategori'     => 'required|numeric',
            'tahunbeli'     => 'required|numeric',
            'merk'      => 'required',
            'harga'     => 'required|numeric',
            'umurekonomis'     => 'required|numeric',
            'nilairesidu'     => 'required|numeric',
            'spek'      => 'required',
            'latitude'      => 'required',
            'longtitude'      => 'required'
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/assets', $image->hashName());

            //delete old image
            Storage::delete('public/assets/'.$asset->image);

            //update post with new image
            $asset->update([
                'image'     => $image->hashName(),
                'asset'     => $request->asset,
                'idkategori'     => $request->idkategori,
                'merk'   => $request->merk,
                'tahunbeli'     => $request->tahunbeli,
                'harga'   => $request->harga,
                'umurekonomis'     => $request->umurekonomis,
                'nilairesidu'     => $request->nilairesidu,
                'spek'   => $request->spek,
                'latitude'     => $request->latitude,
                'longtitude'     => $request->longtitude,
            ]);

        } else {

            //update post without image
            $asset->update([
                'asset'     => $request->asset,
                'idkategori'   => $request->idkategori,
                'merk'   => $request->merk,
                'tahunbeli'     => $request->tahunbeli,
                'harga'   => $request->harga,
                'umurekonomis'     => $request->umurekonomis,
                'nilairesidu'     => $request->nilairesidu,
                'spek'   => $request->spek,
                'latitude'     => $request->latitude,
                'longtitude'     => $request->longtitude,
            ]);
        }

        // $asset->asset = $request->asset;
        // $asset->save();

        return redirect()->route('asset.index')->with('message', 'Asset berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('asset.index')->with('message', 'Asset berhasil dihapus!');
    }

    public function select(Request $request)
    {
        $id = $request->idkategori;
        
        $kategoris = Kategori::all();

        $assets = Asset::join('kategoris', 'assets.idkategori', '=', 'kategoris.id')
        ->select(['assets.*', 'kategoris.kategori'])
        ->where('assets.idkategori',$id)
        ->paginate(2);

        return view('asset.list', [
            'title' =>  'Asset',
            'assets' => $assets,
            'kategoris' => $kategoris
        ]);
    }

    public function search(Request $request)
    {
        $kategoris = Kategori::all();

        $query = $request->get('q');

        $assets = Asset::join('kategoris', 'assets.idkategori', '=', 'kategoris.id')
        ->select(['assets.*', 'kategoris.kategori'])
        ->where('assets.asset', 'LIKE', '%' . $query . '%')
        ->orderBy('assets.id', 'desc')
        ->paginate(10);

        return view('asset.list', [
            'title' =>  'Asset',
            'assets' => $assets,
            'query' => $query,
            'kategoris' =>$kategoris,
        ]);
    }

    public function perbaikan($idasset = 0)
    {

        $perbaikans = Perbaikan::where('perbaikans.idasset',$idasset)
        ->orderBy('perbaikans.tgl', 'desc')
        ->paginate(10);
        

        return view('asset.perbaikan', [
            'title' => 'Perbaikan & Perawatan',
            'perbaikans' => $perbaikans,
            'idasset' => $idasset
        ]);
    }

    public function perbaikancreate($idasset = 0)
    {

        $perbaikans = Perbaikan::where('perbaikans.idasset',$idasset)
        ->paginate(10);

        return view('asset.perbaikancreate', [
            'title' => 'Perbaikan / Perawatan Baru',
            'perbaikans' => $perbaikans,
            'idasset' => $idasset
        ]);
    }

    public function perbaikanstore(Request $request)
    {

        // dd($request);

        $this->validate($request, [
            'idasset'     => 'required',
            'tgl'     => 'required',
            'jenis'     => 'required',
            'keterangan'     => 'required',
            'vendor'     => 'required',
            'harga'     => 'required|numeric'
        ]);

        Perbaikan::create([
            'idasset' => $request->idasset,
            'tgl' => $request->tgl,
            'jenis' => $request->jenis,
            'keterangan' => $request->keterangan,
            'vendor' => $request->vendor,
            'harga' => $request->harga
        ]);

        $idasset = $request->idasset;
        $jenis = $request->jenis;

        return redirect()->route('asset.perbaikan', $idasset)->with('message', $jenis .' berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perbaikanedit($id)
    {
        $perbaikan = Perbaikan::where('id', $id)->first();

        return view('asset.perbaikanedit', [
            'title' => 'Edit Perbaikan / Perawatan',
            'perbaikan' => $perbaikan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perbaikanupdate(Request $request, $id)
    {

        //validate form
        $this->validate($request,[
            'idasset'     => 'required',
            'tgl'     => 'required',
            'jenis'     => 'required',
            'keterangan'     => 'required',
            'vendor'     => 'required',
            'harga'     => 'required|numeric'
        ]);

        Perbaikan::where('id',$id)->update([
            'idasset'     => $request->idasset,
            'tgl'     => $request->tgl,
            'jenis'     => $request->jenis,
            'keterangan'   => $request->keterangan,
            'vendor'   => $request->vendor,
            'harga'   => $request->harga
        ]);

        $idasset = $request->idasset;
        $jenis = $request->jenis;

        return redirect()->route('asset.perbaikan', $idasset)->with('message', $jenis .' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perbaikandestroy($id)
    {
        $idasset = Perbaikan::find($id)->idasset;
        $jenis = Perbaikan::find($id)->jenis;

        Perbaikan::where('id','=',$id)->delete();

        return redirect()->route('asset.perbaikan', $idasset)->with('message', $jenis .' berhasil dihapus !');
    }

    public function penyusutan($id = 0)
    {

        $penyusutan = Asset::where('assets.id',$id)->find($id);

        return view('asset.penyusutan', [
            'title' => 'Penyusutan Asset',
            'penyusutan' => $penyusutan,
            'id' => $id
        ]);
    }

    public function lokasi($id = 0)
    {
        $lokasi = Asset::where('assets.id',$id)->find($id);

        return view('asset.lokasi', [
            'title' => 'Lokasi Asset',
            'lokasi' => $lokasi,
        ]);
    }

    public function qrcode(Asset $asset)
    {
        return view('qrcode.index', [
            'title' => 'Scan QR Code',
            'asset' => $asset
        ]);
    }

    

}
