USE zjutel;

CREATE TABLE IF NOT EXISTS `Node` (
    `id`          INT auto_increment NOT NULL COMMENT '',
    `pid`         INT NOT NULL DEFAULT 0 COMMENT '父节点id',
    `title`       varchar(128) NOT NULL COMMENT '节点标题',
    `has_child`   bool NOT NULL DEFAULT FALSE COMMENT '是否有子节点',
    `is_leaf`     bool NOT NULL DEFAULT FALSE COMMENT '是否为叶节点，叶节点一定有电话号码',
    `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
	KEY (`title`)
)default charset=UTF8 engine=InnoDB,AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Number` (
    `id`          INT auto_increment NOT NULL,
    `nid`         INT NOT NULL,
    `number`      VARCHAR(20) NOT NULL DEFAULT '',
    PRIMARY KEY(`id`),
    FOREIGN KEY(`nid`) REFERENCES `Node`(`id`) ON DELETE CASCADE,
	KEY (`nid`),
	KEY (`number`)
)default charset=UTF8 engine=InnoDB AUTO_INCREMENT=1;

