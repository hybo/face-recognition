<?php

namespace FaceRecognition\Adapters;

use FaceRecognition\Face;
use FaceRecognition\FaceAttributes;
use FaceRecognition\FaceRecognitionInterface;
use FaceRecognition\TencentYoutuInterface;
use FaceRecognition\User;

class TencentYoutuAdapter implements FaceRecognitionInterface
{
    protected $tencentYoutu;

    public function __construct(TencentYoutuInterface $tencentYoutu)
    {
        $this->tencentYoutu = $tencentYoutu;
    }


    /**
     * 人脸检测
     */
    public function detect($image)
    {
        $face = $this->tencentYoutu->detect($image);
        return $this->mapFaceToObject($face);
    }

    /**
     * 人脸对比
     */
    public function compare($imageA, $imageB)
    {
        return $this->tencentYoutu->compare($imageA, $imageB);
    }

    /**
     * 人脸搜索
     */
    public function search($image, array $groupIds)
    {
        return $this->tencentYoutu->search($image, $groupIds);
    }

    /**
     * 新增用户
     */
    public function addUser($image, string $userId, string $groupId, $name = '')
    {
        return $this->tencentYoutu->addPerson($image, $userId, [$groupId], $name);
    }

    /**
     * 更新用户信息
     */
    public function updateUser(string $userId, $name)
    {
        return $this->tencentYoutu->updatePerson($userId, $name);
    }

    /**
     * 删除用户
     */
    public function deleteUser(string $userId, string $groupId = '')
    {
        return $this->tencentYoutu->deletePerson($userId);
    }

    /**
     * 查询用户信息
     */
    public function getUser(string $userId, string $groupId = '')
    {
        $user = $this->tencentYoutu->getPerson($userId);
        return $this->mapUserToObject($user)->merge(['original' => $user]);
    }

    /**
     * 新增人脸
     */
    public function addFace(string $userId, $image, string $groupId = '')
    {
        return $this->tencentYoutu->addFace($userId, [$image]);
    }

    /**
     * 删除人脸
     */
    public function deleteFace(string $userId, string $faceId, string $groupId = '')
    {
        return $this->tencentYoutu->deleteFace($userId, [$faceId]);
    }

    protected function mapUserToObject(array $user)
    {
        return new User([
            'id' => $user['person_id'],
            'group_id' => $user['group_ids'][0],
            'info' => $user['tag'],
        ]);
    }

    protected function mapFaceToObject(array $face)
    {
        return new Face([
            'id' => $face['face_id'],
            'age' => $face['age'],
            'gender' => FaceAttributes::formatGender($face['gender'], [0, 100]),
            'expression' => FaceAttributes::formatExpression($face['expression'], [0, 50, 100]),
            'beauty' => $face['beauty'],
            'glasses' => FaceAttributes::formatGlasses($face['glasses'], [0, 1, 2]),
            'angle' => [
                'yaw' => $face['yaw'],
                'pitch' => $face['pitch'],
                'roll' => $face['roll'],
            ],
        ]);
    }
}