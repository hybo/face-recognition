<?php

namespace FaceRecognition\Adapters;

use ErrorException;
use FaceRecognition\BaiduBCEInterface;
use FaceRecognition\Face;
use FaceRecognition\FaceAttributes;
use FaceRecognition\FaceRecognitionInterface;
use FaceRecognition\User;

class BaiduBCEAdapter implements FaceRecognitionInterface
{
    protected $baiduBCE;

    public function __construct(BaiduBCEInterface $baiduBCE)
    {
        $this->baiduBCE = $baiduBCE;
    }


    /**
     * 人脸检测
     */
    public function detect($image)
    {
        $face = $this->baiduBCE->detect($image, 'URL');

        return $this->mapFaceToObject($face)->merge(['original' => $face]);
    }

    /**
     * 人脸对比
     */
    public function compare($imageA, $imageB)
    {
        $images = [
            [
                'image' => $imageA,
                'image_type' => 'URL',
            ],
            [
                'image' => $imageB,
                'image_type' => 'URL',
            ]
        ];
        return $this->baiduBCE->compare($images);
    }

    /**
     * 人脸搜索
     */
    public function search($image, array $groupIds)
    {
        return $this->baiduBCE->search($image, 'URL', $groupIds);
    }

    /**
     * 新增用户
     */
    public function addUser($image, string $userId, string $groupId, $name = '')
    {
        return $this->baiduBCE->addUser($image, 'URL', $groupId, $userId);
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
        return $this->baiduBCE->deleteUser($groupId, $userId);
    }

    /**
     * 查询用户信息
     */
    public function getUser(string $userId, string $groupId = '')
    {
        $user =  $this->baiduBCE->getUser($userId, $groupId);

        return $this->mapUserToObject($user)->merge(['original' => $user]);
    }

    /**
     * 新增人脸
     */
    public function addFace(string $userId, $image, string $groupId = '')
    {
        return $this->addUser($image, $userId, $groupId);
    }

    /**
     * 删除人脸
     */
    public function deleteFace(string $userId, string $faceId, string $groupId = '')
    {
        return $this->baiduBCE->deleteFace($userId, $groupId, $faceId);
    }

    protected function mapUserToObject(array $user)
    {
        return new User([
            'id' => $user['user_id'],
            'group_id' => $user['group_id'],
            'info' => $user['user_info'],
        ]);
    }

    protected function mapFaceToObject(array $face)
    {
        return new Face([
            'id' => $face['face_token'],
            'age' => $face['age'],
            'gender' => FaceAttributes::formatGender($face['gender']['type']),
            'expression' => FaceAttributes::formatExpression($face['expression']['type']),
            'emotion' => FaceAttributes::formatEmotion($face['emotion']['type']),
            'beauty' => $face['beauty'],
            'glasses' => FaceAttributes::formatGlasses($face['glasses']['type']),
            'race' => FaceAttributes::formatRace($face['race']['type']),
            'angle' => $face['angle'],
        ]);
    }
}