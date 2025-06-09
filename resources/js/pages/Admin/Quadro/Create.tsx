import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';

export default function Create({ workplaces, users }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_workplace: '',
        it_id_user_criador: '',
        vc_nome: '',
        vc_descricao: '',
        vc_visibilidade: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.quadros.store'));
    };

    return (
        <AdminLayout title="Criar Quadro">
            <Head title="Criar Quadro" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Quadro</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.quadros.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_workplace">Espaço de Trabalho</Label>
                            <Select
                                value={data.it_id_workplace}
                                onValueChange={(value) => setData('it_id_workplace', value)}
                            >
                                <SelectTrigger id="it_id_workplace" className={errors.it_id_workplace ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um espaço de trabalho" />
                                </SelectTrigger>
                                <SelectContent>
                                    {workplaces.map((workplace) => (
                                        <SelectItem key={workplace.id} value={workplace.id.toString()}>
                                            {workplace.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_workplace && <p className="text-sm text-red-500">{errors.it_id_workplace}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_criador">Criador</Label>
                            <Select
                                value={data.it_id_user_criador}
                                onValueChange={(value) => setData('it_id_user_criador', value)}
                            >
                                <SelectTrigger id="it_id_user_criador" className={errors.it_id_user_criador ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador" />
                                </SelectTrigger>
                                <SelectContent>
                                    {users.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_user_criador && <p className="text-sm text-red-500">{errors.it_id_user_criador}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_nome">Nome</Label>
                            <Input
                                id="vc_nome"
                                type="text"
                                value={data.vc_nome}
                                onChange={(e) => setData('vc_nome', e.target.value)}
                                className={errors.vc_nome ? 'border-red-500' : ''}
                            />
                            {errors.vc_nome && <p className="text-sm text-red-500">{errors.vc_nome}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_descricao">Descrição</Label>
                            <Textarea
                                id="vc_descricao"
                                value={data.vc_descricao}
                                onChange={(e) => setData('vc_descricao', e.target.value)}
                                className={errors.vc_descricao ? 'border-red-500' : ''}
                            />
                            {errors.vc_descricao && <p className="text-sm text-red-500">{errors.vc_descricao}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_visibilidade">Visibilidade</Label>
                            <Input
                                id="vc_visibilidade"
                                type="text"
                                value={data.vc_visibilidade}
                                onChange={(e) => setData('vc_visibilidade', e.target.value)}
                                className={errors.vc_visibilidade ? 'border-red-500' : ''}
                            />
                            {errors.vc_visibilidade && <p className="text-sm text-red-500">{errors.vc_visibilidade}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}