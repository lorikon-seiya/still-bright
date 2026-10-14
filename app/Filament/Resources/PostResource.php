<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = '文章管理';
    protected static ?string $modelLabel = 'post';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 左侧主编辑区 (占据 8 列)
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('文章内容')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('文章标题')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label('URL 别名 (Slug)')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                Forms\Components\Textarea::make('summary')
                                    ->label('文章摘要')
                                    ->rows(3),

                                Forms\Components\MarkdownEditor::make('content')
                                    ->label('Markdown 正文')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 8]),

                // 右侧属性区 (占据 4 列)
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('分类与标签')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('所属分类')
                                    ->relationship('category', 'name')
                                    ->required(),

                                Forms\Components\Select::make('tags')
                                    ->label('关联标签')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->preload(),

                                Forms\Components\Select::make('swift_version')
                                    ->label('Swift 版本')
                                    ->options([
                                        'Swift 6.0' => 'Swift 6.0',
                                        'Swift 5.10' => 'Swift 5.10',
                                        'Swift 5.9' => 'Swift 5.9',
                                    ])
                                    ->default('Swift 6.0')
                                    ->required(),

                                Forms\Components\Select::make('target_platform')
                                    ->label('目标平台')
                                    ->options([
                                        'iOS 18+ / macOS 15+' => 'iOS 18+ / macOS 15+',
                                        'iOS 17+ / macOS 14+' => 'iOS 17+ / macOS 14+',
                                        'Cross-platform' => '跨平台',
                                    ]),
                            ]),

                        Forms\Components\Section::make('发布设置')
                            ->schema([
                                Forms\Components\Toggle::make('is_published')
                                    ->label('立即发布')
                                    ->default(true),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('发布时间')
                                    ->default(now()),

                                Forms\Components\FileUpload::make('cover_image')
                                    ->label('封面图片')
                                    ->image()
                                    ->directory('posts-covers'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 4]),
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('封面'),
                Tables\Columns\TextColumn::make('title')->label('标题')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('category.name')->label('分类'),
                Tables\Columns\TextColumn::make('swift_version')->label('Swift 版本'),
                Tables\Columns\IconColumn::make('is_published')->label('发布状态')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('发布时间')->dateTime('Y-m-d H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->relationship('category', 'name')->label('按分类筛选'),
                Tables\Filters\TernaryFilter::make('is_published')->label('按发布状态筛选'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
