<?php

namespace FaceRecognition;

interface FaceRecognitionInterface
{
    /**
     * 人脸检测
     */
    public function detect($image);

    /**
     * 人脸对比
     */
    public function compare($imageA, $imageB);

    /**
     * 人脸搜索
     */
    public function search($image, array $groupIds);

    /**
     * 新增用户
     */
    public function addUser($image, string $userId, string $groupId, $name = '');

    /**
     * 更新用户信息
     */
    public function updateUser(string $userId, $name);

    /**
     * 删除用户
     */
    public function deleteUser(string $userId, string $groupId = '');

    /**
     * 查询用户信息
     */
    public function getUser(string $userId, string $groupId = '');

    /**
     * 新增人脸
     */
    public function addFace(string $userId, $image, string $groupId = '');

    /**
     * 删除人脸
     */
    public function deleteFace(string $userId, string $faceId, string $groupId = '');
}