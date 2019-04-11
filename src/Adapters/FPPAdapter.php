<?php

namespace FaceRecognition\Adapters;

use ErrorException;
use FaceRecognition\FaceRecognitionInterface;
use FaceRecognition\FPPInterface;

class FPPAdapter implements FaceRecognitionInterface
{
    protected $fPP;

    public function __construct(FPPInterface $fPP)
    {
        $this->fPP = $fPP;
    }

    /**
     * 人脸检测
     */
    public function detect($image)
    {
        return $this->fPP->detect($image);
    }

    /**
     * 人脸对比
     */
    public function compare($imageA, $imageB)
    {
        return $this->fPP->compare($imageA, $imageB);
    }

    /**
     * 人脸搜索
     */
    public function search($image, array $groupIds)
    {
        throw new ErrorException('暂不提供此接口');
        // return $this->fPP->search($image, $groupIds[0]);
    }

    /**
     * 新增用户
     */
    public function addUser($image, string $userId, string $groupId, $name = '')
    {
        throw new ErrorException('暂不提供此接口');
        // $result = $this->detect($image);
        // return $this->fPP->createFaceset($groupId, $result['faces'][0]['face_token'], $name);
    }

    /**
     * 更新用户信息
     */
    public function updateUser(string $userId, $name)
    {
        throw new ErrorException('暂不提供此接口');
    }

    /**
     * 删除用户
     */
    public function deleteUser(string $userId, string $groupId = '')
    {
        throw new ErrorException('暂不提供此接口');
    }

    /**
     * 查询用户信息
     */
    public function getUser(string $userId, string $groupId = '')
    {
        throw new ErrorException('暂不提供此接口');
    }

    /**
     * 新增人脸
     */
    public function addFace(string $userId, $image, string $groupId = '')
    {
        throw new ErrorException('暂不提供此接口');
    }

    /**
     * 删除人脸
     */
    public function deleteFace(string $userId, string $faceId, string $groupId = '')
    {
        throw new ErrorException('暂不提供此接口');
    }
}