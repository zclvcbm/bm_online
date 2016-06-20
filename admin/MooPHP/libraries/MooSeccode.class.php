<?php
/*
	more & original php framwork
	copyright (c) 2007 - 2008 ismole inc.

	$id: mooseccode.class.php 38 2008-03-19 07:39:17z aming $
*/

!defined('IN_MOOPHP') && exit('Access Denied');

class MooSeccode {
	//note:生成的验证码
	var $cecCode = '';
	//note:生成的图片
	var $codeImage = '';
	//note:干扰素
	var $disturColor = '';
	//note:验证码的图片宽度
	var $codeImageWidth = '80';
	//note:验证码的图片高度
	var $codeImageHeight  = '20';
	//note:验证码位数
	var $cecCodeNum = 4;
	
	/**
	 * 输出头部
	 *
	 */
	function outHeader() {
		header("content-type: image/png");
	}
	
	/**
	 * 生成验证码
	 *
	 */
	function createCode() {
		$this->cecCode = strtoupper(substr(md5(rand()),0,$this->cecCodeNum));
		return $this->cecCode;
	}

	/**
	 * 生成验证码图片
	 *
	 */
	function createImage() {
		$this->codeImage = @imagecreate($this->codeImageWidth,$this->codeImageHeight);
		imagecolorallocate($this->codeImage, 200, 200, 200);
		return $this->codeImage;
	}
	
	/**
	 * 加入图片干拢素
	 *
	 */
	function setDisturbColor() {
		for ($i=0; $i<=128; $i++) {
			$this->disturColor = imagecolorallocate($this->codeImage, rand(0,255), rand(0,255), rand(0,255));
			imagesetpixel($this->codeImage,rand(2,128),rand(2,38),$this->disturColor);
		}
	}

	/**
	 * 设置验证码图片的大小
	 *
	 * @param integer $width：
	 * @param integer $height：
	 * @return boolean;
	 */
	function setCodeImage($width, $height) {
		if($width == '' || $height == '') { return false; }
		$this->codeImageWidth = $width;
		$this->codeImageHeight = $height;
		return true;
	}

	/**
	 * 在图片上写入验证码
	 *
	 * @param integer $num
	 */
	function writeCodeToImage($num = '') {
		if($num != '') {$this->cecCodeNum = $num;}
		for($i = 0; $i <= $this->cecCodeNum; $i++) {
			$bg_color = imagecolorallocate ($this->codeImage, rand(0,255), rand(0,128), rand(0,255));
			$x = floor($this->codeImageWidth / $this->cecCodeNum) * $i;
			$y = rand(0,$this->codeImageHeight - 15);
			imagechar($this->codeImage, 5, $x, $y, $this->cecCode[$i], $bg_color);
		}
	}
	
	/**
	 * 把验证码的值写入session
	 *
	 * @param string $sname
	 */
	function writeSession($sname) {
		session_start();
		session_register($sname);
		$_SESSION[$sname] = md5($this->cecCode);
	}

	/**
	 * 输出验证码图片
	 *
	 * @param integer $width
	 * @param integer $height
	 * @param integer $num
	 * @param string $sname
	 */
	function outCodeImage($width = '', $height = '' ,$num = '', $sname = 'code') {
		if($width !== '' || $height !== '') {
			$this->setCodeImage($width, $height);
		}
		$this->outHeader();
		$this->createCode();
		$this->createImage();
		$this->setDisturbColor();
		$this->writeCodeToImage($num);
		$this->writeSession($sname);
		imagepng($this->codeImage);
		imagedestroy($this->codeImage);
	}
}